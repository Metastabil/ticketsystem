<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/projects/ticketsystem/shared.php';

$title = LANG['TabTitles']['UsersIndex'];

require_once dirname(__DIR__) . '/templates/header.php';

$users = $user->get();
?>

<h1 class="default-title"><?= LANG['Users']['Titles']['Index']; ?></h1>

<a href="<?= ApplicationHelper::create_redirect_link('users/create'); ?>" title="<?= LANG['Actions']['Create']; ?>" class="btn btn-create">
    <?= LANG['Actions']['Create']; ?>
</a>

<div class="grid"></div>

<script>
    $(document).ready(function() {
        let json = <?= json_encode($users); ?>;

        prepareDataForDataGrid(json);
        renderDataGrid();
    });

    function prepareDataForDataGrid(json) {
        $.each(json, function(index, value) {
            let element = {};

            element.id = value['ID'];
            element.email = value['Email'];
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
                caption: lang['Users']['Attributes']['Email']
            }, {
                dataField: 'createdAt',
                caption: lang['Users']['Attributes']['CreatedAt']
            }, {
                dataField: 'updatedAt',
                caption: lang['Users']['Attributes']['UpdatedAt']
            }, {
                type: 'buttons',
                buttons: ['edit', 'delete', {
                    hint: lang['Actions']['Edit'],
                    cssClass: 'fa-solid fa-pen-to-square',
                    onClick: function(e) {
                        window.location.href = baseURL + 'users/edit/' + e.data.id
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
</script>