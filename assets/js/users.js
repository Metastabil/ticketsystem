/*
 * Functions for the views/users/index.php
 */
function usersIndexDataGrid(json) {
    let dataGridContainer = $('.grid');

    dataGridContainer.dxDataGrid({
        dataSource: json,
        keyExpr: 'id',
        showBorders: false,
        filterRow: { visible: false },
        searchPanel: { visible: false },
        paging: { pageSize: 10 },
        allowColumnResizing: true,
        columns: [{
            dataField: 'first_name',
            caption: lang['Users']['Attributes']['FirstName']
        }, {
            dataField: 'last_name',
            caption: lang['Users']['Attributes']['LastName']
        }, {
            dataField: 'email',
            caption: lang['Users']['Attributes']['Email']
        }, {
            dataField: 'created_at',
            caption: lang['Users']['Attributes']['CreatedAt']
        }, {
            dataField: 'updated_at',
            caption: lang['Users']['Attributes']['UpdatedAt']
        }, {
            type: 'buttons',
            buttons: ['password', 'edit', 'delete', {
                hint: lang['Actions']['Password'],
                cssClass: 'fa-solid fa-wrench',
                onClick: function(e) {
                    window.location.href = baseURL + 'users/password/' + e.row.data.id
                }
            }, {
                hint: lang['Actions']['Edit'],
                cssClass: 'fa-solid fa-pen-to-square',
                onClick: function(e) {
                    window.location.href = baseURL + 'users/edit/' + e.row.data.id
                }
            }, {
                hint: lang['Actions']['Delete'],
                cssClass: 'fa-solid fa-trash',
                onClick: function(e) {
                    let confirmation = confirm(lang['Users']['Popups']['ConfirmDelete']);

                    if (confirmation) {
                        window.location.href = baseURL + 'users/delete/' + e.row.data.id
                    }
                }
            }]
        }],
        onRowClick: function(e) {
            window.location.href = baseURL + 'users/show/' + e.data.id
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