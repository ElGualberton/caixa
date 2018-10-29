/**
 * Passa os dados da Tabela para o Modal, e atualiza o link para exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget);
  var id = button.data('id');
  
  var modal = $(this);
  modal.find('.modal-title').text('ATENÇÃO! ' + id );
  modal.find('#confirm').attr('href', 'delete.php?id=' + id);
})


$('#modal-exclusao').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget);
  var id = button.data('cxs_tipo_id');
  
  var modal = $(this);
  modal.find('.modal-title').text('ATENÇÃO! ' + id );
  modal.find('#confirm').attr('href', 'delete.php?id=' + cxs_tipo_id);
})

