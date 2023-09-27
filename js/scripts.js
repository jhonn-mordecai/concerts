//====================================
// FUNCTIONS
//====================================

function addLoadingRow() {
    
    $('.list-container').append('<div style="width:100%;font-size:1.8rem;text-align:center;"><p><i class="fa fa-spinner fa-spin"></i></p></div>');
}

function addNoResultsRow() {

    $('.list-container').append('<div style="width:100%;font-size:1.2rem;text-align:center;"><p>Sorry, nothing there.</p></div>');
}

function clearConcerts() {

    $('.list-container').html('');
}

function loadAllConcerts() {

   $.ajax({
       type:"POST",
       url:"ajax.php",
       dataType:"json",
       timeout:5000,
       data:{
           action:'load_all_concerts'
       },
       error:function(msg) {
           return false;
       },
       success: function(msg) {

            let concert_html = msg.concert_html;
            let concert_count = msg.concert_count;
            let city_count = msg.city_count;
            let venue_count = msg.venue_count;
            
            $('.cities').html(`${city_count} <span class="stat-label">Cities</span>`);
            $('.venues').html(`${venue_count} <span class="stat-label">Venues</span>`);
            $('.concert-count').html(`${concert_count} <span class="stat-label">Shows</span>`);
            $('div.list-container').html(concert_html);
       }
   });
}

function collapseClass(size) {

    if (size.matches) {
        $('#search-container').addClass('collapse');
    } else {
        $('#search-container').removeClass('collapse');
    }
}

//====================================
// HANDLING SEARCHES & LOADS
//====================================

// TEXT SEARCH
$('#concert-search input[name=text-search]').on('keyup', function(){

    let text_search = $(this).val();
    
    if (text_search.length === 0) {
        $('#concert-search select').attr('disabled',false);
        $('button.btn-clear').attr('disabled',true);
        $('.stats-row .stat-badge').show();
    } else {
        $('#concert-search select').attr('disabled',true);
    }
    
    $.ajax({
        type:"POST",
        url:"ajax.php",
        dataType:"json",
        timeout:5000,
        data:{
            action:'text_search',
            text_search: text_search
        },
        error: function(msg) {
            return false;
        },
        success: function(msg) {

            let concert_html = msg.concert_html;
            let concert_count = msg.concert_count;
            let city_count = msg.city_count;
            let venue_count = msg.venue_count;

            city_count == 1 ? $('.cities').html(`${city_count} <span class="stat-label">City</span>`) : $('.cities').html(`${city_count} <span class="stat-label">Cities</span>`);
            venue_count == 1 ? $('.venues').html(`${venue_count} <span class="stat-label">Venue</span>`) : $('.venues').html(`${venue_count} <span class="stat-label">Venues</span>`);
            concert_count == 1 ? $('.concert-count').html(`${concert_count} <span class="stat-label">Show</span>`) : $('.concert-count').html(`${concert_count} <span class="stat-label">Shows</span>`);

            clearConcerts();
            addLoadingRow();
            $('button.btn-clear').attr('disabled',false);
            $('.stats-row .stat-badge').hide();
            $('div.list-container').html(concert_html);

            if (concert_count == 0) {addNoResultsRow();}
        }
    });
});

$('#concert-search input[name=text-search]').on('blur', function(){
    if($(this).val().length === 0) {
        $('button.btn-clear').attr('disabled',true);
        $('.stats-row .stat-badge').show();
    }
});

//SEARCH BY YEAR
$('#concert-search select').on('change', function(){

    let year = $(this).find('option:selected').val();
    
    if ( $(this).val() == '') {

        addLoadingRow();
        loadAllConcerts();
        $('.stats-row .stat-badge').show();
        $('#concert-search input').attr("disabled",false);
        $('button.btn-clear').attr('disabled',true);
        return false;
    }
   
    $.ajax({
        type:"POST",
        url:"ajax.php",
        dataType:"json",
        timeout:5000,
        data:{
            action:'search_year',
            year: year
        },
        error: function(msg) {
            return false;
        },
        success: function(msg) {

            let concert_html = msg.concert_html;
            let concert_count = msg.concert_count;
            let city_count = msg.city_count;
            let venue_count = msg.venue_count;
            
            city_count == 1 ? $('.cities').html(`${city_count} <span class="stat-label">City</span>`) : $('.cities').html(`${city_count} <span class="stat-label">Cities</span>`);
            venue_count == 1 ? $('.venues').html(`${venue_count} <span class="stat-label">Venue</span>`) : $('.venues').html(`${venue_count} <span class="stat-label">Venues</span>`);
            concert_count == 1 ? $('.concert-count').html(`${concert_count} <span class="stat-label">Show</span>`) : $('.concert-count').html(`${concert_count} <span class="stat-label">Shows</span>`);

            clearConcerts();
            addLoadingRow();
            $('#concert-search input').attr("disabled",true);
            $('button.btn-clear').attr('disabled',false);
            $('.stats-row .stat-badge').hide();
            $('div.list-container').html(concert_html);

            //Scroll to content when selecting a concert year
            $('html,body').animate({
				scrollTop: $('.search-card').offset().top - 25
			});
        }
    });
});

// CLEAR SEARCH + RELOAD
$('button.btn-clear').on('click', function(){
    
    $(this).attr('disabled', true);
    $('#concert-search input').val('');
    $('#concert-search input').attr("disabled",false);
    $('#concert-search select').val('');
    $('#concert-search select').attr('disabled',false);
    $('.stats-row .stat-badge').show();

    clearConcerts();
    addLoadingRow();
    loadAllConcerts();
});


// OPEN+CLOSE DIALOG MODALS
let openModalBtn = document.querySelectorAll('.open-modal');
let closeModalBtn = document.querySelectorAll('.close-modal');

for (let thisOpenBtn of openModalBtn) {
    thisOpenBtn.addEventListener("click", (e) => {
        e.preventDefault();
        let modalTarget = e.target.getAttribute('data-target-modal');
        let modal = document.getElementById(modalTarget);
        modal.showModal();
        modal.setAttribute("aria-hidden", "false");
    });
}

for (let thisCloseBtn of closeModalBtn) {
    thisCloseBtn.addEventListener("click", (e) => {
        e.preventDefault();
        e.target.closest('dialog').close();
        e.target.closest('dialog').setAttribute("aria-hidden", "true");
    })
}


// DOCUMENT READY
$(document).ready(function(){

    addLoadingRow();
    loadAllConcerts();
    
    // Fade in .back-top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 425) { 
            $('.back-top').fadeIn('fast'); 
        } else { 
            $('.back-top').fadeOut('fast'); 
        }
    });

    // Scroll body to top when clicking .back-top
    $('.back-top a').click(function() {
        $('body,html').animate({scrollTop: 0}, 800);
        return false;
    });

    //Enable Collapsible search panel
    var size = window.matchMedia( "(max-width: 737px)" );
    collapseClass(size);
    size.addListener(collapseClass);

    $('.toggle-search-view').on('click', function(){

        let icon = $(this).find('i');

        if ( icon.hasClass('fa-chevron-circle-right') ) {
            icon.removeClass('fa-chevron-circle-right').addClass('fa-chevron-circle-down');
        }
        else if ( icon.hasClass('fa-chevron-circle-down') ) {
            icon.removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-right');
        }

    });
    
    //Enable Dark Mode v. Light Mode

    $('.mode-switches button').on('click', function(){

        $(this).css('outline', 'none');

        if ( $(this).hasClass('sun-btn') ) {

            $(this).addClass('active-mode');
            $('.moon-btn').removeClass('active-mode');
            $('.page-wrapper').removeClass('dark-mode');
            $('span.badge-pill').removeClass('badge-light').addClass('badge-dark');
            $('.btn-clear').removeClass('btn-light').addClass('btn-dark');
        }
        else if ( $(this).hasClass('moon-btn')  ) {

            $(this).addClass('active-mode');
            $('.sun-btn').removeClass('active-mode');
            $('.page-wrapper').addClass('dark-mode');
            $('span.badge-pill').removeClass('badge-dark').addClass('badge-light');
            $('.btn-clear').removeClass('btn-dark').addClass('btn-light');
        }

    });

});