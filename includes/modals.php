<dialog id="disclaimers" class="my-modal" role="dialog" aria-labelledby="disclaimers" aria-hidden="true">
    <p>
        <button class="close-modal" aria-label="Close">&times; Close</button>
    </p>
    <h3 class="stats-modal-title">Disclaimers</h3>
    <p>
        While I strove over the years to keep track of everything, this archive may not be 100% complete in the strictest sense. Random bar bands, and the various and quite numerous shows for local bands/friends' bands were often not counted for the sake of this database (unless they were on a bill as an opening act, etc.). There may still possibly be a tiny number of others that I failed to track and have forgotten.
    </p>
    <p style="margin-bottom:0;">Also included are a couple various other events like stand-up comedy performances or talks by anyone important... "marquee events," so to speak.</p>  
    <hr />
    <p>
        My first concert - The New Kids On the Block - is guessed to have taken place in either late 1989, or early 1990, but the actual date is unknown. Despite my research, I can't find a record of it anywhere online. Several other teen pop groups of the time were opening acts; some likely contenders being Sweet Sensation, the Cover Girls, etc.
    </p>  
    <hr>
    <p><b>COVID GAP</b></p>
    <p>Everything was shut down for most of 2020 and part of 2021 due to the COVID pandemic; hence the lack of much during those years.</p>
</dialog>

<dialog id="concert_year_modal" class="my-modal" role="dialog" aria-labelledby="concert_year_modal" aria-hidden="true">
    <p>
        <button class="close-modal" aria-label="Close">&times; Close</button>
    </p>
    <h3 class="stats-modal-title">Most Concerts By Year</h3>
    <?php foreach($concerts_by_year as $year => $count): ?>
    <div class="stats-modal-row">
        <p class="stat-item-title band-title"><?= $year; ?></p>
        <span class="sub-info">
            <?php if($count == 1): ?>
            <?= $count; ?> show
            <?php else: ?>
            <?= $count; ?> shows
            <?php endif; ?>
        </span>
    </div>
    <?php endforeach; ?>
</dialog>

<dialog id="artists_modal" class="my-modal" role="dialog" aria-labelledby="artists_modal" aria-hidden="true">
    <p>
        <button class="close-modal" aria-label="Close">&times; Close</button>
    </p>
    <h3 class="stats-modal-title">Most-Seen Artists</h3>
    <p class="note">Seen five times or more.</p>
    <?php foreach($top_bands as $band => $count): ?>
    <div class="stats-modal-row">
        <p class="stat-item-title band-title"><?= $band; ?></p>
        <span class="sub-info"><?= $count; ?> times</span>
    </div>
    <?php endforeach; ?>
</dialog>

<dialog id="venues_modal" class="my-modal" role="dialog" aria-labelledby="venues_modal" aria-hidden="true">
    <p>
        <button class="close-modal" aria-label="Close">&times; Close</button>
    </p>
    <h3 class="stats-modal-title">20 Most-Visited Venues</h3>
    <?php foreach($top_venues as $venue => $data): ?>
    <div class="stats-modal-row">
        <div class="venue-left">
            <p class="stat-item-title venue-title"><?= $venue; ?></p>
            <span class="venue-city sub-info"><?= $data['city_state']; ?></span>
        </div>
        <div class="venue-right">
            <span><?= $data['count']; ?> shows</span> 
        </div>
    </div>
    <?php endforeach; ?>
</dialog>

<dialog id="cities_modal" class="my-modal" role="dialog" aria-labelledby="cities_modal" aria-hidden="true">
    <p>
        <button class="close-modal" aria-label="Close">&times; Close</button>
    </p>
    <h3 class="stats-modal-title">10 Most-Visited Towns</h3>
    <?php foreach($top_cities as $city => $count): ?>
    <div class="stats-modal-row">
        <p class="stat-item-title city-title"><?= $city; ?></p>
        <span class="sub-info"><?= $count; ?> shows</span>
    </div>
    <?php endforeach; ?>
</dialog>