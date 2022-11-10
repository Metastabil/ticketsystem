<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

$title = LANG['TabTitles']['StatusIndex'];

require_once dirname(__DIR__) . '/templates/header.php';

$status_array = $status->get();
?>

<h1 class="default-title"><?= LANG['Status']['Titles']['Index']; ?></h1>

<a href="<?= ApplicationHelper::create_redirect_link('status/create'); ?>" title="<?= LANG['Actions']['Create']; ?>" class="btn btn-create">
    <?= LANG['Actions']['Create']; ?>
</a>

<div class="grid"></div>

<script>
    $(document).ready(function() {
        let json = <?= json_encode($status_array); ?>;

        renderDataGrid(json);
    });

    function renderDataGrid(json) {
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
                dataField: 'Name',
                caption: lang['Status']['Attributes']['Name']
            }, {
                dataField: 'CreatedAt',
                caption: lang['Status']['Attributes']['CreatedAt']
            }, {
                dataField: 'UpdatedAt',
                caption: lang['Status']['Attributes']['UpdatedAt']
            }, {
                type: 'buttons',
                buttons: ['edit', 'delete', {
                    hint: lang['Actions']['Edit'],
                    cssClass: 'fa-solid fa-pen-to-square',
                    onClick: function(e) {
                        window.location.href = baseURL + 'status/edit/' + e.row.data.ID
                    }
                }, {
                    hint: lang['Actions']['Delete'],
                    cssClass: 'fa-solid fa-trash',
                    onClick: function(e) {
                        let confirmation = confirm(lang['Status']['Popups']['ConfirmDelete']);

                        if (confirmation) {
                            window.location.href = baseURL + 'status/delete/' + e.row.data.ID
                        }
                    }
                }]
            }],
            onRowClick: function(e) {
                window.location.href = baseURL + 'status/show/' + e.data.ID
            }
        });
    }
</script>