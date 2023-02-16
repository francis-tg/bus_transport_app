{% extends ../views/layouts/main.shadow.php %}
{% block title %}{{ $title }}{% endblock %}
{% block content %}

<div class="container-sm container-fluid">
   <div class="mb-3">
    <button class="btn btn-primary" data-toggle="modal" data-target="#addTrajet"><i class="fas fa-plus"></i> Ajouter un trajet
    </button>
   </div>
   
    <div class="table-responsive">
    <table class="table table-striped-columns
    table-bordered">
        <thead>
            <caption>Trajet</caption>
            <tr>
                <th>Départ</th>
                <th>Destination</th>
                <th>Heure de départ</th>
                <th>Heure de d'arrivée</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr >
                    <td scope="row">Item</td>
                    <td>Item</td>
                    <td>Item</td>
                    <td>Item</td>
                </tr>
                <tr >
                    <td scope="row">Item</td>
                    <td>Item</td>
                    <td>Item</td>
                    <td>Item</td>
                </tr>
            </tbody>
            <tfoot>
                
            </tfoot>
    </table>
</div>    
</div>

<div class="modal fade" id="addTrajet" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="addTrajetId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTrajetId">Ajouter un trajet</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                    <label> Départ </label>
                    <input type="text" name="depart" id="depart" class="form-control" placeholder="depart">
                </div>
                <div class="form-group">
                    <label>Prenom</label>
                    <input type="text" name="arrive" id="arrive" class="form-control" placeholder="arrive">
                </div>
                <div class="form-group">
                    <label>Heure Départ</label>
                    <input type="time" name="heure_depart" id="heure_depart" class="form-control" placeholder="Heure de départ">
                </div>
                <div class="form-group">
                    <label>Heure Arrivée</label>
                    <input type="time" name="heure_arrive" id="heure_arrive" class="form-control" placeholder="Heure d'arrivée">
                </div>
                <button type="button" class="btn btn-primary w-100">Enregistrer</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                
            </div>
        </div>
    </div>
</div>


<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(document.getElementById('addTrajet'), options)

</script>


{% endblock %}