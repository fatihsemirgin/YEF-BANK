<?php $user = get_active_user(); ?>
<div class="container">
    <h2 class="text-center">Login Records</h2>
    <div class="row text-center">
        <h3 class="mt-5">Last 5 Successful Log-ins</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($logins as $login) {; ?>
                    <tr>
                        <th scope="row"> <?php echo $i; ?>
                        </th>
                        <td> <?php echo $login->Date; ?>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php }; ?>
            </tbody>
        </table>
    </div>
    <div class="row text-center">
        <h3 class="mt-5">Last 5 Wrong Log-ins</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($wrong_logins as $login) {; ?>
                    <tr>
                        <th scope="row"> <?php echo $i; ?>
                        </th>
                        <td> <?php echo $login->Date; ?>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php }; ?>
            </tbody>
        </table>
    </div>
</div>