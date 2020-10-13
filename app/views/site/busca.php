<?php
    if(!empty($_busca)):
?>
<main id="main-doc">
        <?php
            foreach($_busca as $r):
        ?>
        <a class="busca" href="<?= $r->url->link ;?>">
            <section>
                <header>
                    <h2><?= $r->titulo; ?></h2>
                </header>
                <article>
                    <?= $r->texto; ?>
                </article>
            </section>
        </a>   
        <div class="linha"></div>
        <?php
            endforeach;
        ?>
    </main>    
<?php
    endif;
?>