/*
 * Functions for the views/users/index.php
 */
function usersIndexDataGrid(json) {
    let dataGridContainer = $('.grid');

    dataGridContainer.dxDataGrid({
        dataSource: json,
        keyExpr: 'ID',
        showBorders: false,
        filterRow: { visible: false },
        searchPanel: { visible: false },
        paging: { pageSize: 10 },
        allowColumnResizing: true,
        columns: [{
            dataField: 'Email',
            caption: lang['Users']['Attributes']['Email']
        }, {
            dataField: 'CreatedAt',
            caption: lang['Users']['Attributes']['CreatedAt']
        }, {
            dataField: 'UpdatedAt',
            caption: lang['Users']['Attributes']['UpdatedAt']
        }, {
            type: 'buttons',
            buttons: ['edit', 'delete', {
                hint: lang['Actions']['Edit'],
                cssClass: 'fa-solid fa-pen-to-square',
                onClick: function(e) {
                    window.location.href = baseURL + 'users/edit/' + e.row.data.ID
                }
            }, {
                hint: lang['Actions']['Delete'],
                cssClass: 'fa-solid fa-trash',
                onClick: function(e) {
                    let confirmation = confirm(lang['Users']['Popups']['ConfirmDelete']);

                    if (confirmation) {
                        window.location.href = baseURL + 'users/delete/' + e.row.data.ID
                    }
                }
            }]
        }],
        onRowClick: function(e) {
            window.location.href = baseURL + 'users/show/' + e.data.ID
        }
    });
}

/*
 * Functions for the views/users/show.php
 */
function usersShowDataGridProjects(json) {
    // TODO
}

function usersShowDataGridTickets(json) {
    // TODO
}