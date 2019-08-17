<div class="container">
    <div class="row">
        <div class="card mx-auto mt-5" style="width: 35em;">
            <div class="card-header">User</div>
            <div class="card-body">
                <form id="form" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Name..">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="email@email.com">
                    </div>
                    <button type="submit" id="save" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <?= $this->view->name; ?>
    </div>
</div>
<?php $this->importJsScripts("user"); ?>
