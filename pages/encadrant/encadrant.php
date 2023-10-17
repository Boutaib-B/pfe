
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Listes des modules</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Tableau de Bord</a></li>
        <li class="breadcrumb-item active">Liste des modules</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">  
   
    <div class="row">



      <div class="card">
        <form role="form" method="POST" class="form-horizontal mt-3 g-3 needs-validation" action="" novalidate > 

          <div class="card-header card-title"> <i class="bx bx-list-ul"></i> Liste des modules  </div>

          <?php 
            if(isset($_POST['btn_supprimer'])){
              if(!empty($_POST['id_Module'])){ 
                try{
                  $id_Module = $_POST['id_Module']; 
                  $cmd = $connected->prepare("DELETE fROM `module` WHERE id_Module = $id_Module"); 
                  $cmd->execute(array("id_Module"=>$id_Module)); 
                  if($cmd == true){ ?>
                    <div class="alert alert-success" role="alert">
                      La supprission à été effectuer avec succés
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> <?php 
                  }
                  else{?>
                    <div class="alert alert-danger" role="alert">
                      Erreur !
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> <?php 
                  }
                } 
                catch(Exception $e)
                {
                  die('Erreur : '.$e->getMessage());
                }  
              }
            }
          ?>

          <?php 
            if(isset($_POST['btn_modification'])){
              if(!empty($_POST['id_Module'])){ 
                try{
                  $id_Module = $_POST['id_Module']; 
                  $intitule = $_POST['intitule']; 
                  $Formateur = $_POST['Formateur']; 
                  $Formation = $_POST['Formation'];
                  $description = $_POST['description']; 
                  $cmd = $connected->prepare("UPDATE `module` SET `Intitule`=:intitule, `Formateur`=:Formateur, `Formation`=:Formation, `Description`=:description WHERE `module`.`id_Module`=:id_Module"); 

                  $cmd->execute(array("id_Module"=>$id_Module, ":intitule"=>$intitule, ":Formateur"=>$Formateur, ":Formation"=>$Formation, ":description"=>$description)); 
                  if($cmd == true){ ?>
                    <div class="alert alert-success" role="alert">
                      La modification à été effectuer avec succés
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> <?php 
                  }
                  else{?>
                    <div class="alert alert-danger" role="alert">
                      Erreur !
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> <?php 
                  }
                } 
                catch(Exception $e)
                {
                  die('Erreur : '.$e->getMessage());
                }  
              }
            }
          ?>

              

          <div class="card-body mt-5">  
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col" width="10%">#</th>
                  <th scope="col" width="25%">Intitule</th>
                  <th scope="col" width="20%">Formateur</th>
                  <th scope="col" width="25%">Formation</th>
                  <th scope="col" width="20%">#</th>
                </tr>
              </thead>
              <tbody>
                <?php 

                   $cmd = $connected->query("SELECT * FROM `module` "); 
                         
                    if($cmd){
                      while ($data = $cmd->fetch()){
                ?>

                        <tr>
                          <th scope="row"><?php  echo $data["id_Module"]; ?></th>
                          <td><?php  echo $data["Intitule"]; ?></td>
                          <td><?php  
                                $cmd = $connected->query("SELECT * FROM `formateur` ");  
                                if($cmd){
                                  while ($data3 = $cmd->fetch()){
                                    echo $data3["Nom"].' '.$data3["Prenom"];
                                  }
                                }
                              ?></td>
                          <td><?php  
                                $cmd = $connected->query("SELECT * FROM `formation` ");  
                                if($cmd){
                                  while ($data3 = $cmd->fetch()){
                                    echo $data3["Intitule"];
                                  }
                                }
                              ?></td>
                          <td class="text-center">

                            <!-- btn-Details -->
                            <button type="button" class="btn btn-secondary" name="btn-Details" id="btn-Details" title="Plus de détail" data-toggle="modal" data-target="#detail_role<?php  echo $data["id_Module"];?>">
                              <i class="bi bi-eye-fill"></i> 
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="detail_role<?php  echo $data["id_Module"];?>" tabindex="-1" role="dialog" aria-labelledby="detail_role" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content text-left">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="">Plus de details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="counter">
                                        <div class="row mt-4">
                                          <div class="col-12">
                                            <form action="test.html" method="POST" id="roleform">
                                                <div class="form-group row" >
                                                  <label for="inputIntitule" class="col-sm-3 col-form-label">Intitule :</label>
                                                  <div class="col-sm-9">
                                                     <label for="inputIntitule" class="col-sm-3 col-form-label">
                                                      <?php 
                                                      echo $data["Intitule"];
                                                       ?>
                                                      </label> 
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                  <label for="inputFormateur" class="col-sm-3 col-form-label mt-1">Formateur :</label>
                                                  <div class="col-sm-9">
                                                      <label for="inputIntitule" class="col-sm-3 col-form-label">
                                                      <?php  
                                                        $cmd = $connected->query("SELECT * FROM `formateur` ");  
                                                        if($cmd){
                                                          while ($data3 = $cmd->fetch()){
                                                            echo $data3["Nom"].' '.$data3["Prenom"];
                                                          }
                                                        }
                                                      ?>
                                                    </label>
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                  <label for="inputDate_debut" class="col-sm-3 col-form-label mt-1">Formation :</label>
                                                  <div class="col-sm-9">
                                                    <label for="inputFormation" class="col-sm-3 col-form-label">
                                                        <?php 
                                                        $cmd = $connected->query("SELECT * FROM `formation` ");  
                                                          if($cmd){
                                                            while ($data3 = $cmd->fetch()){
                                                              echo $data3["Intitule"];
                                                            }
                                                          }
                                                         ?>
                                                        </label>
                                                  </div>  
                                                </div>
                                                <div class="form-group row">
                                                  <label for="inputDate_fin" class="col-sm-3 col-form-label mt-1">Duree :</label>
                                                  <div class="col-sm-9">
                                                    <label for="inputDuree" class="col-sm-3 col-form-label">
                                                        <?php 
                                                        echo $data["Duree"];
                                                         ?>
                                                        </label>
                                                  </div>  
                                                </div>
                                                <div class="form-group row">
                                                  <label for="inputDescription" class="col-sm-3 col-form-label mt-1">Description :</label>
                                                  <div class="col-sm-9">
                                                    <label for="inputIntitule" class="col-sm-3 col-form-label">
                                                        <?php 
                                                        echo $data["Description"];
                                                         ?>
                                                        </label>
                                                  </div>  
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>  
                                </div>
                              </div>
                            </div>
                            
                            

                            <!-- btn-modifier -->
                            <button type="button" class="btn btn-warning" name="btn-modifier" id="btn-modifier" title="Modifier"  data-toggle="modal" data-target="#modifier_role<?php  echo $data["id_Module"];?>">
                              <i class="bx bx-edit"></i> 
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="modifier_role<?php  echo $data["id_Module"];?>" tabindex="-1" role="dialog" aria-labelledby="modifier_role" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="modifierrole">Modifier le module </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="" method="POST" id="roleform">
                                       <div class="modal-body">
                                        <div class="counter">
                                          <div class="row mt-4">
                                            <div class="col-12">
                                              <div class="form-group row"> inserer les nouveaux donnees du formation :
                                                <input type="text" class="form-control mt-3 hidden" name="id_Module" id="id_Module" value="<?php  echo $data["id_Module"];?>">
                                              </div>
                                              <div class="form-group row" >
                                                <label for="inputIntitule" class="col-sm-3 col-form-label">Intitule :</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="intitule" class="form-control" id="intitule" value="<?php  echo $data["Intitule"];?>">
                                                </div>
                                              </div>
                                              <div class="form-group row">
                                                <label for="inputFormateur" class="col-sm-3 col-form-label mt-1">Formateur :</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" id="validationDefault04" name="Formateur" id="Formateur" required="">
                                                      <option selected="" disabled="" value=""> -- SELLECTIONNER --</option>
                                                      <?php  

                                                        $cmd = $connected->query("SELECT * FROM `formateur` ");  
                                                        if($cmd){
                                                          while ($data2 = $cmd->fetch()){?> 
                                                            <option value="<?php  echo $data2["id_Formateur"]; ?>"><?php  echo $data2["Nom"].' '.$data2["Prenom"] ?></option><?php  
                                                          }
                                                        }
                                                      ?>
                                                    </select>
                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                <label for="inputFormation" class="col-sm-3 col-form-label mt-1">Formation :</label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" id="validationDefault04" name="Formation" id="Formation" required="">
                                                      <option selected="" disabled="" value=""> -- SELLECTIONNER --</option>
                                                      <?php  

                                                        $cmd = $connected->query("SELECT * FROM `formation` ");  
                                                        if($cmd){
                                                          while ($data2 = $cmd->fetch()){?> 
                                                            <option value="<?php  echo $data2["id_Formation"]; ?>"><?php  echo $data2["Intitule"] ?></option><?php  
                                                          }
                                                        }
                                                      ?>
                                                    </select>
                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                <label for="inputDescription" class="col-sm-3 col-form-label mt-1">Description :</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" rows="5" name="description" id="description"><?php  echo $data["Description"];?></textarea>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuller</button>
                                          <button type="submit" class="btn btn-primary" name="btn_modification" id="btn_modification">Modifier</button>
                                      </div>
                                    </form>
                                  
                                </div>
                              </div>
                            </div>  

                            <!-- btn-Suppression -->

                            <button type="button" class="btn btn-danger" name="btn-Suppression" id="btn-Suppression" title="Modifier" data-toggle="modal" data-target="#suprrimer_role<?php  echo $data["id_Module"];?>">
                              <i class="bx bx-trash"></i>
                            </button>  
                            <!-- Modal -->
                            <div class="modal fade" id="suprrimer_role<?php  echo $data["id_Module"];?>" tabindex="-1" role="dialog" aria-labelledby="supprimer_role" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <form role="form" method="POST" class="form-horizontal mt-3 g-3 needs-validation" action="" novalidate > 
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="supprimer_role">Suprrimer le role</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      Voulez-vous vraiment supprimer le role <?php  echo $data["Intitule"];?> ?
                                      <input type="text" class="form-control mt-3 hidden" name="id_Module" id="id_Module" value="<?php  echo $data["id_Module"];?>">
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuller</button>
                                      <button type="submit" class="btn btn-danger" name="btn_supprimer" id="btn_supprimer">Supprimer</a></button>
                                    </div>
                                  </div>
                                </form>  
                              </div>
                            </div>
                            
                          </td>
                        </tr>

                      <?php 
                        
                      }
                      $cmd->closeCursor();
                    }


                ?>
                 
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
               
          </div>
          <div class="card-footer text-right">
            <button type="reset" class="btn btn-dark" onclick='document.getElementById("intitule").focus();'>
              <i class="bx bx-x"></i>  <a href="index.php" style="color: white;">retour</a>
            </button>
            <button type="button" class="btn btn-primary" name="btn_enregistrer" id="btn_enregistrer">
              <i class="bx bxs-plus-square"></i> <a href="page.php?lien=add_module" style="color: white;">ajouter un module</a>  
            </button>
          </div>
        </form>
      </div><!-- card -->

    </div> <!-- row -->

  </section> 

</main><!-- End #main -->