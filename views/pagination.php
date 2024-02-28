<div id="pagination" class="pagination m-auto d-flex flex-row justify-content-center align-items-center w-25 mt-4">
        <?php for($i=1;$i<=$params['nbPage'];$i++) : ?>
            <!-- si on est dans la page courrant on met un bg-color et on change la couleur du text  -->
            <a class="page-link border text-dark border-dark m-1 btn
            <?php
                if(isset($params['page'])){
                    if($params['page'] === $i ){
                        echo("bg-dark text-white text-white");
                    }
                }
             ?>"  href="<?= $i ?>"><?= $i ?></a>
        <?php endfor ?>
</div>