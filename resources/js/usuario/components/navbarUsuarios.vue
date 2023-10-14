<template>
    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link :to="{ name: 'formUsuario' }" type="button" class="btn btn-outline-success"><i class="bi bi-person-fill-add"
                                style="font-size: 2rem;"></i>
                            <h6>Agregar Usuario</h6>
                        </router-link>
                        <router-link :to="{ name: 'listaUsuarios' }" type="button" class="btn btn-outline-success"><i class="bi bi-card-checklist"
                                style="font-size: 2rem;"></i>
                            <h6>Listar Usuario</h6>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
  
<script>
export default {
    name: 'Navbar',
};
</script>
  