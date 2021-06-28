<!DOCTYPE html>
<html lang="en">
    <head>


    </head>
    <body>
        <div class="container">
            <div class="well">
            <h3>Entreprise conventionné</h3>
            <hr>
            <div class="row  col-md-8 col-md-offset-2 custyle ">
                <span class="">Cliquez sur Filtre pour chercher</span><br><br>
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h2 class="panel-title">Cours</h3>
                            <div class="pull-right">
                                <button class="btn btn-default btn-xs btn-filter">
                                    <span class="glyphicon glyphicon-filter"></span> Filter</button>
                            </div>
                    </div>
                    <table class="table" >
                        <thead>
                            <tr class="filters">
                                <th><input type="text" class="form-control" placeholder="Nom" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Pays" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Adresse" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Mail" disabled></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($allentreprise as $t) {
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo $t->nom . " " . $t->prenom;
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $t->pays; ?>
                                    </td>
                                    <td>
                                        <?php echo $t->adresse; ?>
                                    </td>
                                    <td>
                                        <?php echo $t->mail; ?>
                                    </td>

                                </tr>

                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div></div>
        </div>
        <script type="text/javascript">
            /*
             Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
             */
            $(document).ready(function () {
                $('.filterable .btn-filter').click(function () {
                    var $panel = $(this).parents('.filterable'),
                            $filters = $panel.find('.filters input'),
                            $tbody = $panel.find('.table tbody');
                    if ($filters.prop('disabled') == true) {
                        $filters.prop('disabled', false);
                        $filters.first().focus();
                    } else {
                        $filters.val('').prop('disabled', true);
                        $tbody.find('.no-result').remove();
                        $tbody.find('tr').show();
                    }
                });

                $('.filterable .filters input').keyup(function (e) {
                    /* Ignore tab key */
                    var code = e.keyCode || e.which;
                    if (code == '9')
                        return;
                    /* Useful DOM data and selectors */
                    var $input = $(this),
                            inputContent = $input.val().toLowerCase(),
                            $panel = $input.parents('.filterable'),
                            column = $panel.find('.filters th').index($input.parents('th')),
                            $table = $panel.find('.table'),
                            $rows = $table.find('tbody tr');
                    /* Dirtiest filter function ever ;) */
                    var $filteredRows = $rows.filter(function () {
                        var value = $(this).find('td').eq(column).text().toLowerCase();
                        return value.indexOf(inputContent) === -1;
                    });
                    /* Clean previous no-result if exist */
                    $table.find('tbody .no-result').remove();
                    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                    $rows.show();
                    $filteredRows.hide();
                    /* Prepend no-result row if all rows are filtered */
                    if ($filteredRows.length === $rows.length) {
                        $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No result found</td></tr>'));
                    }
                });
            });
        </script>
    </body>
</html>
