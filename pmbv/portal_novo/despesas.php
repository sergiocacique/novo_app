<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 29/08/14
 * Hora: 10:20
 * Página: Servidor
 *
 */


?>
<div id="breadcrumb">
    <div id="breadcrumb_primeiro"><span>Consultas</span></div>
    <div id="breadcrumb_ultima"><span>Despesas</span></div>
</div>
<div id="corpo_servidor">
    <div id="btn_inicio"><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=despesas_empenho" class="btn_inicio">Empenho</a></div>
    <div id="btn_inicio"><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=despesas_lista">Liquidações de despesas</a></div>
    <div id="btn_inicio"><a href="javascript:void(0)">Liquidações de restos a pagar</a></div>
</div>