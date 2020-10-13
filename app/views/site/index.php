<?php
    $r = $_topico;
    if(!empty($r)):
?>
<main id="main-doc">
        <section class="sessao" id="primeiro">
            <header>
                <h2><?= $r->titulo; ?></h2>
            </header>
            <article>
                <?= $r->texto; ?>
            </article>
        </section>
    </main>
    
<?php
    endif;
?>