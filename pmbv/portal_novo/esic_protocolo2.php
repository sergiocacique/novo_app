    <div id="breadcrumb">
        <div id="breadcrumb_primeiro"><span>Sistema e-SIC</span></div>
        <div id="breadcrumb_ultima"><span>Protocolos</span></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Meus Protocolos</h3>
                </div><!-- /panel-heading -->

                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Protocolo</th>
                            <th>Data</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sqlProtocolos = mysql_query("SELECT * FROM sic_ticket WHERE CdUsuario = '".$_SESSION['IDSIC']."' ORDER BY DtAtualizacao DESC");
                        $Protocolos = mysql_num_rows($sqlProtocolos);

                        for ($y = 0; $y < $Protocolos; $y++){
                        $verProtocolos = mysql_fetch_array($sqlProtocolos);
                        ?>
                        <tr onclick="location.href='?Pages=esic_protocolo_ver&protocolo=<?php echo base64_encode($verProtocolos['Protocolo']);?>'" style="cursor: pointer">
                            <td><?php echo $verProtocolos['Protocolo'];?></td>
                            <td><?php echo strftime('%d/%m/%Y', strtotime($verProtocolos['DtCadastro']));?></td>
                            <td><?php echo $verProtocolos['Acao'];?></td>
                        </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div><!-- /panel-body -->
            </div><!-- /panel-rpcdefault -->



        </div><!-- /.cols -->
    </div>