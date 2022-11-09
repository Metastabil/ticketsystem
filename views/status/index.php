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

        prepareDataForDataGrid(json);
        renderDataGrid();
    });

    function prepareDataForDataGrid(json) {
        $.each(json, function(index, value) {
            let element = {};

            element.id = value['ID'];
            element.email = value['Name'];
            element.createdAt = value['CreatedAt'];
            element.updatedAt = value['UpdatedAt'];

            elements.push(element);
        });
    }

    function renderDataGrid() {
        let dataGridContainer = $('.grid');

        dataGridContainer.dxDataGrid({
            dataSource: elements,
            keyExpr: 'id',
            showBorders: false,
            filterRow: { visible: false },
            searchPanel: { visible: false },
            paging: { pageSize: 10 },
            allowColumnResizing: true,
            columns: [{
                dataField: 'email',
                caption: lang['Status']['Attributes']['Name']
            }, {
                dataField: 'createdAt',
                caption: lang['Status']['Attributes']['CreatedAt']
            }, {
                dataField: 'updatedAt',
                caption: lang['Status']['Attributes']['UpdatedAt']
            }, {
                type: 'buttons',
                buttons: ['edit', 'delete', {
                    hint: lang['Actions']['Edit'],
                    cssClass: 'fa-solid fa-pen-to-square',
                    onClick: function(e) {
                        window.location.href = baseURL + 'status/edit/' + e.data.id
                    }
                }, {
                    hint: lang['Actions']['Delete'],
                    cssClass: 'fa-solid fa-trash',
                    onClick: function(e) {
                        let confirmation = confirm(lang['Status']['Popups']['ConfirmDelete']);

                        if (confirmation) {
                            window.location.href = baseURL + 'status/delete/' + e.row.data.id
                        }
                    }
                }]
            }],
            onRowClick: function(e) {
                window.location.href = baseURL + 'status/show/' + e.data.id
            }
        });
    }
</script>