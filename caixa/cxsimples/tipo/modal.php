<!-- Modal de Delete-->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" 
                class="close" 
                data-dismiss="modal" 
                aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="modalLabel">Excluisão do Tipo de Movimento <?php echo $cxsimples_tipo['id']; ?></h4>
      </div>
      <div class="modal-body"> 
        Deseja realmente excluir este Tipo?
      </div>
      <div class="modal-footer">
        <a id="confirm"  class="btn btn-primary" href="#">Sim</a>
        <a id="cancel"   class="btn btn-default" data-dismiss="modal">N&atilde;o</a>
        <a id="question" class="btn btn-info" 
           href="https://api.whatsapp.com/send?phone=5511952189891&text=Estou%20com%20duvidas%20nesse%20Item%20MODALCXS_TIPO_REM">
           Precisa de Ajuda?
        </a>
      </div>
    </div>
  </div>
</div> <!-- /.modal -->