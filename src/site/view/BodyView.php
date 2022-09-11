<div class="Presbody">
    <center><h1>PresBodyBox</h1></center>
</div>
<div class="Newsbody">
    <!-- début affichage des news -->
        <?php foreach ($news as $new) { ?>
            <div class="news">
                <h2><?= $new->getTitle() . ' [' . $new->getAuthor() . ' : ' . $new->getPublishedDate() . ']' ?></h2>
                <p><?= $new->getContent() ?></p>
            </div>
        <?php } ?>
    <!-- fin affichage des news -->
</div>
<div class="Eventsbody">
    <center><h1>EventsbodyBox</h1></center>
</div>