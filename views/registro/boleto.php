<main class="pagina">
    <h2 class="pagina__heading"><?php echo $titulo; ?></h2>
    <p class="pagina__descripcion">Tu Boleto - Te recomendamos almacenarlo, puedes compartirlo en redes sociales.</p>
    
    <div class="boleto-virtual">

        <div class="boleto boleto--<?php echo strtolower($registro->paquete->nombre); ?> boleto--acceso">
            <div class="boleto__contenido">
                <h4 class="boleto__logo">&#60;DevWebCamp /></h4>
                <p class="boleto__plan"><?php echo $registro->paquete->nombre; ?></p>
                <p class="boleto__nombre"><?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido; ?></p>
            </div>

            <p class="boleto__codigo"><?php echo '#' . $registro->token; ?></p>
        </div>
    </div>
    <?php if($registro->paquete_id === '1'){ ?>

        <h2 class="agenda__heading">Eventos elegidos</h2>
        
    <?php if (array_key_exists('conferencias_v', $eventos) || array_key_exists('conferencias_s', $eventos)) {?>
            
            <h3 class="eventos__heading">&lt;Conferencias /></h3>
    <div class="eventos">

     <?php } ?>

        <?php if (array_key_exists('conferencias_v', $eventos)) {?>
                       
            <?php if ($eventos['conferencias_v'][0]->dia_id ==='1') {?>

                    <p class="eventos__fecha">Viernes 5 de Octubre</p>
                    
                <div class="eventos__listado slider swiper">
                    <div class="swiper-wrapper">
                        <?php foreach($eventos['conferencias_v'] as $evento ) { ?>
                            <?php include __DIR__ . '../../templates/evento.php'; ?>
                            <?php } ?>
                    </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php if (array_key_exists('conferencias_s', $eventos)) {?>
            <?php if ($eventos['conferencias_s'][0]->dia_id ==='2') {?>
                    <p class="eventos__fecha">Sábado 6 de Octubre</p>
                    
                    <div class="eventos__listado slider swiper">
                        <div class="swiper-wrapper">
                            <?php foreach($eventos['conferencias_s'] as $evento ) { ?>
                                <?php include __DIR__ . '../../templates/evento.php'; ?>
                                <?php } ?>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
            <?php } ?>
        <?php } ?>
    </div>
    

    <?php if (array_key_exists('workshops_v', $eventos) || array_key_exists('workshops_s', $eventos)) {?>
        
        <div class="eventos eventos--workshops">   
        <h3 class="eventos__heading">&lt;Workshops /></h3>

        <?php } ?>

    <?php if (array_key_exists('workshops_v', $eventos)) {?>
            
        <?php if ($eventos['workshops_v'][0]->dia_id ==='1') {?>
                
        <p class="eventos__fecha">Viernes 5 de Octubre</p>            
                <div class="eventos__listado slider swiper">
                    <div class="swiper-wrapper">
                        <?php foreach($eventos['workshops_v'] as $evento ) { ?>
                            <?php include __DIR__ . '../../templates/evento.php'; ?>
                            <?php } ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
        <?php } ?>
    <?php } ?>                
            
    <?php if (array_key_exists('workshops_s', $eventos)) {?>
            
        <?php if ($eventos['workshops_s'][0]->dia_id ==='2') {?>
                
        <p class="eventos__fecha">Sábado 6 de Octubre</p>

            <div class="eventos__listado slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($eventos['workshops_s'] as $evento ) { ?>
                    <?php include __DIR__ . '../../templates/evento.php'; ?>
                <?php } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
    <?php } ?>
    
    
</main> 