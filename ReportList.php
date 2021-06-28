<html lang="fr">

    <head>

    </head>

    <body>
        <div class="container">
            <div class="row  col-md-9 col-md-offset-1 custyle ">
                <table class="table table-striped custab ">
                    <thead>
                        <tr>
                        <tr>
                            <th>Titre</th>
                            <th>Professeur</th>
                            <th>Nombre de Reports</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <br>
                    <?php foreach ($CoursesList as $course) { ?>


                        <br><tr>
                            <td><?php echo $course->Titre ?></td>
                            <td><?php echo $course->Nom ?></td>
                            <td><?php echo $course->nombre ?></td>
                            
                            <td>
                                <a href="<?php echo BASE_URL . '/administration/deleteCourse/' . $course->id ?>" class= "btn btn-danger btn-xs">
                                    <span class="glyphicon glyphicon-remove" onclick="return confirm('Voulez-vous vraiment supprimer le cours?');"></span> Supprimer</a></td>
                                    <?php
                                    echo '</tr>';
                                }
                                ?>        

                </table>
                </body>
                </HTML>