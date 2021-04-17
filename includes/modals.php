<div class="modal fade stats-modal" id="disclaimer" tabindex="-1" role="dialog" aria-labelledby="disclaimer" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <h3 class="stats-modal-title">Disclaimers</h3>
                    <div class="row">
                        <div class="col-12">
	                        <p>While I strove over the years to keep an accurate and complete record, there are no-doubt shows I may have missed; maybe a random band seen at a bar one night, or a few bands that my own various bands shared a bill with on tour, etc.<br />I decided in most cases not to include local bands/friends, unless they were featured on the bill as an opener. Therefore, this list may not be 100% complete in the strictest-possible sense. The actual number of gigs attended, all inclusive, is far more.</p>
                            <p style="margin-bottom:0;">Also included are a couple various other events like stand-up comedy performances or talks by anyone important... "marquee events," so to speak.</p>  
                            <hr />
                            <p>
                                My first concert - The New Kids On the Block - is guessed to have taken place in either late 1989, or early 1990, but the actual date is unknown. Despite my research, I can't find a record of it anywhere online. Several other teen pop groups of the time were opening acts; some likely contenders being Sweet Sensation, the Cover Girls, etc.</p>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade stats-modal" id="concert_year_modal" tabindex="-1" role="dialog" aria-labelledby="concert_year_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <h3 class="stats-modal-title">Most Concerts By Year</h3>
                    <?php foreach($concerts_by_year as $year => $count): ?>
                    <div class="row stats-modal-row">
                        <div class="col-12 text-center">
                            <p class="stat-item-title band-title"><?= $year; ?></p>
                            <span>
                                <?php if($count == 1): ?>
                                <?= $count; ?> show
                                <?php else: ?>
                                <?= $count; ?> shows
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade stats-modal" id="artists_modal" tabindex="-1" role="dialog" aria-labelledby="artists_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <h3 class="stats-modal-title">Most-Seen Artists</h3>
                    <p class="text-center font-italic text-muted note">Seen five times or more.</p>
                    <?php foreach($top_bands as $band => $count): ?>
                    <div class="row stats-modal-row">
                        <div class="col-12 text-center">
                            <p class="stat-item-title band-title"><?= $band; ?></p>
                            <span><?= $count; ?> times</span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade stats-modal" id="venues_modal" tabindex="-1" role="dialog" aria-labelledby="venues_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <h3 class="stats-modal-title">20 Most-Visited Venues</h3>
                    <?php foreach($top_venues as $venue => $data): ?>
                    <div class="row stats-modal-row align-items-end">
                        <div class="col-9">
                            <p class="stat-item-title venue-title"><?= $venue; ?></p>
                            <span class="venue-city"><?= $data['city_state']; ?></span>
                        </div>
                        <div class="col-3 text-right">
                            <span><?= $data['count']; ?> shows</span> 
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade stats-modal" id="cities_modal" tabindex="-1" role="dialog" aria-labelledby="cities_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <h3 class="stats-modal-title">10 Most-Visited Towns</h3>
                    <?php foreach($top_cities as $city => $count): ?>
                    <div class="row stats-modal-row">
                        <div class="col-12 text-center">
                            <p class="stat-item-title city-title"><?= $city; ?></p>
                            <span><?= $count; ?> shows</span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>