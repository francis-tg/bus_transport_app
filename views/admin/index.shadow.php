
{% extends ../views/layouts/main.shadow.php %}
{% block title %}{{ $title }}{% endblock %}
{% block content %}
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Admin</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4>Total Admin: *</h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->


  <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/add-user" id="addUser" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Nom </label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom">
            </div>
            <div class="form-group">
                <label>Prenom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prenom">
            </div>
            <div class="form-group">
                <label>Contact</label>
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Contact">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
              <label for="">Selectionner le role</label>
              <select class="form-control" name="id_role" id="role">
                <option value="">Selectionner un role</option>
              {% foreach ($roles as $role):%}
                <option value="{{$role['id']}}">{{$role["nom_role"]}}</option>
              {% endforeach %}
                
              </select>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Admin Profile 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Admin Profile 
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Username </th>
            <th>Email </th>
            <th>Contact</th>
            <th>editer </th>
            <th>suprimer</th>
          </tr>
        </thead>
        <tbody>
     
         {% foreach ($users as $value): %}

            <tr>
            <td> 1 </td>
            <td>{{$value["nom"]}}</td>
            <td> {{$value["prenom"]}}</td>
            <td> {{$value["phone"]}}</td>
            <td>
                <button  class="btn btn-success" data-target="#edit{{$value['id']}}" data-toggle="modal">editer</button>
            </td>
            <td>
                  <button name="delete_btn"  class="btn btn-danger">supprimer</button>
            </td>
          </tr>

          <div id="edit{{$value['id']}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <form action="/edit-user" method="post">
                    <div class="form-group">
                      <label for="">Nom</label>
                      <input type="text" 
                        class="form-control" name="nom" id="" aria-describedby="helpId" placeholder="Nom" value="{{$value['nom']}}">
                      <small id="helpId" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="">Prenom</label>
                      <input type="text" 
                        class="form-control" name="prenom" id="" aria-describedby="helpId" placeholder="Prenom" value="{{$value['prenom']}}">
                      <small id="helpId" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="">Contact</label>
                      <input type="tel" 
                        class="form-control" name="phone" id="" aria-describedby="helpId" placeholder="Contact" value="{{$value['phone']}}">
                      <small id="helpId" class="form-text text-muted"></small>
                    </div>
                    <input type="hidden" name="user_id" value="{{$value['id']}}">
                    <button class="btn btn-primary w-100" type="submit">Modifier</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
         {% endforeach; %}
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
<script src="/js/main.js"></script>
<script>

/* document.querySelector("#addUser").addEventListener("submit",(e)=>{
 
  let isvalid = false;
  const formEl = e.target.querySelector(".modal-body").children
  for (const key in formEl) {
    if (Object.hasOwnProperty.call(formEl, key)) {
      const element = formEl[key];
      if(element.querySelector(".form-control").value!==""){
        isvalid = true
      }else {
        isvalid = false;
        e.preventDefault();

      }
    }

  }

  console.log(formData)

  

}) */
</script>




{% endblock %}
