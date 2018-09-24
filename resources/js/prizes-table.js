export class PrizesTable {

    constructor() {
        this.table = $("#prizes_table");
        this.startedStatus = 'started';
        this.acceptedStatus = 'accepted';
    }

    drawTable() {
        $.ajax({
            url: '/prizes/list',
            success: (data) => {
                this.table.find('tbody').empty();
                data['items'].forEach(item => {
                    let row =  $('<tr/>', {class: '', prizeId: item.id});
                    row.append($('<td/>').append(item.type));
                    row.append($('<td/>').append(item.value));
                    row.append($('<td/>').append(item.status));
                    if (item.status === this.startedStatus) {
                        row.append($('<td/>').append($("<button/>", {class: 'accept'}).append('Принять')).append($("<button/>", {class: 'decline'}).append('Отказаться')));
                    } else if (item.status === this.acceptedStatus && item.type === 'MoneyPrize') {
                        row.append($('<td/>').append($("<button/>", {class: 'exchange'}).append('Обменять на баллы')));
                    } else {
                        row.append($('<td/>').append($("<span/>")));
                    }
                    this.table.find('tbody').append(row);
                });
            }
        })
    }

    changePrizeStatus(element, status) {
        element.attr('disabled', 'disabled');
        const prizeId = element.parents('tr').attr('prizeId');
        $.ajax({
            url: 'prizes/changeStatus',
            data: {
                prizeId: prizeId,
                status: status
            },
            success: () => {
                this.drawTable()
            },
            complete: () => {
                element.removeAttr('disabled');
            }
        })
    }

    exchange(element) {
        element.attr('disabled', 'disabled');
        const prizeId = element.parents('tr').attr('prizeId');
        $.ajax({
            url: 'prizes/exchange',
            data: {prizeId: prizeId},
            success: () => {
                this.drawTable()
            },
            complete: () => {
                element.removeAttr('disabled');
            }
        })
    }
}