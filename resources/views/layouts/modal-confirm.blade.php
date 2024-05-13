
<div class="modal fade" id="myModal" data-backdrop="true">
    <div class="modal-dialog modal-lg">

    <div class="modal-content">
        <div class="modal-header">
            <b>
            ¿Desea concluir la evaluación de: {{ $docente->odocente }}?
            </b>
            <button type="button" class="close" data-dismiss="modal" style="color:red;">&times;</button>
        </div>

        <div class="modal-body">
            Recuerda que antes de evaluar, puedes cambiar el valor de alguna(s) de las preguntas si así lo deseas. De lo contrario así quedaran tus respuestas guardadas. 
            <br><br>

            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-outline-secondary btn-sm btn-block" 
                        data-dismiss="modal">
                    <span class="fas fa-reply"></span> Continuar evaluando
                </button>
                <br>
                <button class="btn btn-outline-success btn-sm btn-block"
                            onclick="submitform();" >
                        <b> Sí, evaluar </b>
                        <span class="fas fa-check"></span>
                    </button>
                </div>
            </div>

            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>
