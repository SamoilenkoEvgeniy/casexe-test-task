require('./bootstrap');

import {PrizesTable} from "./prizes-table";

$(window).ready(function() {

    const prizesTable = new PrizesTable();

    $(document).on('click', '#getRandomPrize', function(event) {
        event.preventDefault();
        const that = $(this);

        that.attr('disabled', 'disabled');

        $.ajax({
            url: '/prize/random',
            success: () => {
                prizesTable.drawTable();
            },
            complete: () => {
                that.removeAttr('disabled');
            }
        });

        return false;
    });

    $(document).on('click', '#prizes_table .accept', function(event) {
        event.preventDefault();
        prizesTable.changePrizeStatus($(this), 'accepted');
        return false;
    });

    $(document).on('click', '#prizes_table .decline', function(event) {
        event.preventDefault();
        prizesTable.changePrizeStatus($(this), 'declined');
        return false;
    });

    $(document).on('click', '#prizes_table .exchange', function(event) {
        event.preventDefault();
        prizesTable.exchange($(this));
        return false;
    });

    prizesTable.drawTable();

});