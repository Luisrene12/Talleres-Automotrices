<!-- MODAL CRUD GENERAL -->
<div class="modal" id="crudModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="crudModalTitle">Agregar Registro</h3>
            <button class="close-modal-btn" onclick="closeCrudModal()">&times;</button>
        </div>
        <form id="crudForm" onsubmit="handleCrudSubmit(event)">
            <!-- Los campos se inyectan dinámicamente por JS -->
            <div id="dynamicFormFields"></div>
            <div class="form-actions">
                <button type="button" class="btn-primary btn-secondary" onclick="closeCrudModal()">Cancelar</button>
                <button type="submit" class="btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- TOAST DE NOTIFICACIONES -->
<div class="toast-notification" id="toastBox" style="display: none;">
    <div class="toast-message">
        <i class="fa-solid fa-circle-check"></i>
        <span id="toastText">¡Listo!</span>
    </div>
    <div class="toast-actions">
        <button class="toast-feedback-btn"><i class="fa-regular fa-thumbs-up"></i></button>
        <button class="toast-feedback-btn"><i class="fa-regular fa-thumbs-down"></i></button>
        <button class="toast-feedback-btn" onclick="closeToast()"><i class="fa-solid fa-xmark"></i></button>
    </div>
</div>
