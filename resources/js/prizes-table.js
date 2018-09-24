export class PrizesTable {

    constructor() {
        this.table = $("#prizes_table");
        this.startedStatus = 'started';
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
                        row.append($('<td/>').append($("<button/>", {class: 'accept'}).append('Принять')));
                        row.append($('<td/>').append($("<button/>", {class: 'decline'}).append('Отказаться')));
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
}