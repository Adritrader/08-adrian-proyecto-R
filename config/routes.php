<?php

/* Default routes */
$router->get("old", "DefaultController", "index");
$router->get("contact", "DefaultController", "contact");
$router->post("contact", "DefaultController", "contact");
$router->get("api/demo", "DefaultController", "demo");

/* My routes Front-End */
$router->get("", "MyController", "index");
$router->get("servicios", "MyController", "servicios");
$router->get("quienes-somos", "MyController", "quienesSomos");
$router->get("galeria", "MyController", "galeria");
$router->get("blog", "MyController", "blog");
$router->get("contacto", "MyController", "contacto");
$router->get("tienda", "MyController", "tienda", [],"tienda");
$router->get("signup", "MyController", "signup");
$router->get("single-page", "MyController", "single-page");


/*Login routes */
$router->get("login", "AuthController", "login");
$router->post("login", "AuthController", "checkLogin");

/*Logout routes */

$router->get("logout", "AuthController", "logout");
$router->post("logout", "AuthController", "checkLogin");


/* BackOffice routes */

$router->get("back-index", "BackController", "backIndex");
$router->get("back-reservas", "BackController", "backReservas");
$router->get("back-galeria", "BackController", "backGaleria");
$router->get("back-blog", "BackController", "backBlog");
$router->get("back-productos", "BackController", "backProductos");
//$router->get("back-pedidos", "BackController", "backPedidos");
$router->get("back-usuarios", "BackController", "backUsuarios");


/*BackOffice Productos routes*/

$router->get("productos", "ProductoController", "index", [], "producto_index", "ROLE_ADMIN");
$router->post("productos", "ProductoController", "filterProducto", [], "producto_filter", "ROLE_ADMIN");
$router->get("productos/create", "ProductoController", "createProducto", [], "producto_create", "ROLE_ADMIN");
$router->post("productos/create", "ProductoController", "storeProducto", [], "producto_store", "ROLE_ADMIN");
$router->get("productos/:id/edit", "ProductoController", "editProducto", ["id" => "number"], "producto_edit", "ROLE_ADMIN");
$router->post("productos/:id/edit", "ProductoController", "updateProducto", ["id" => "number"], "producto_update", "ROLE_ADMIN");
$router->get("productos/:id/show", "ProductoController", "showProducto", ["id" => "number"], "producto_show");
$router->get("productos/:id/delete", "ProductoController", "deleteProducto", ["id" => "number"],"productos_delete", "ROLE_ADMIN");
$router->post("productos/delete", "ProductoController", "destroyProducto", [], "productos_destroy", "ROLE_ADMIN");


/*BackOffice Pedidos routes */

$router->get("back-pedidos", "PedidoController", "index", [], "pedidos_index", "ROLE_ADMIN");
$router->post("pedidos", "BackController", "filter", [], "pedidos_filter", "ROLE_ADMIN");
$router->get("pedidos/create", "PedidoController", "createPedido", ["id" => "number"], "pedidos_create", "ROLE_USER");
$router->post("pedidos/create", "PedidoController", "storePedido", ["id" => "number"], "pedidos_store", "ROLE_USER");
$router->get("pedidos/:id/edit", "MovieController", "edit", ["id" => "number"]);
$router->post("pedidos/:id/edit", "MovieController", "edit", ["id" => "number"]);
$router->get("pedidos/:id/show", "BackController", "showPedido",
    ["id" => "number"], "pedidos_show");
$router->get("pedidos/delete", "BackController", "deletePedido", [],"pedidos_delete", "ROLE_ADMIN");


/* BackOffice Usuarios routes */

$router->get("usuarios", "UsuarioController", "index", [], "usuario_index", "ROLE_ADMIN");
$router->post("usuarios", "UsuarioController", "filterUsuario", [], "usuario_filter", "ROLE_ADMIN");
$router->get("perfil/:id/show", "UsuarioController", "perfilUsuario", ["id" => "number"], "usuario_show", "ROLE_USER");
$router->get("perfil/:id/verReservas", "UsuarioController", "verReservas", ["id" => "number"], "usuario_reservas", "ROLE_USER");
$router->get("perfil/:id/verPedidos", "UsuarioController", "verPedidos", ["id" => "number"], "usuario_pedidos", "ROLE_USER");

$router->get("usuarios/create", "UsuarioController", "createUsuario", [], "usuarios_create");
$router->post("usuarios/create", "UsuarioController", "storeUsuario", [], "usuarios_store");
$router->get("usuarios/:id/edit", "UsuarioController", "editUsuario", ["id" => "number"],"usuarios_edit", "ROLE_ADMIN");
$router->post("usuarios/:id/edit", "UsuarioController", "updateUsuario", ["id" => "number"], "usuarios_update", "ROLE_ADMIN");

$router->get("usuarios/:id/editPerfil", "UsuarioController", "editPerfilUsuario", ["id" => "number"],"usuarios_edit_perfil", "ROLE_USER");
$router->post("usuarios/:id/editPerfil", "UsuarioController", "updatePerfilUsuario", ["id" => "number"], "usuarios_update_perfil", "ROLE_USER");

$router->get("usuarios/:id/editPass", "UsuarioController", "editPassUsuario", ["id" => "number"],"usuarios_edit_perfil", "ROLE_USER");
$router->post("usuarios/:id/editPass", "UsuarioController", "updatePassUsuario", ["id" => "number"], "usuarios_update_perfil", "ROLE_USER");

$router->get("usuarios/:id/show", "UsuarioController", "showUsuario",
    ["id" => "number"], "usuarios_show");
$router->get("usuarios/:id/show", "UsuarioController", "perfilUsuario",
    ["id" => "number"], "usuarios_show");
$router->get("usuarios/:id/delete", "UsuarioController", "deleteUsuario", ["id" => "number"],"usuarios_delete", "ROLE_ADMIN");
$router->post("usuarios/delete", "UsuarioController", "destroyUsuario", [], "usuarios_destroy", "ROLE_ADMIN");


/* BackOffice Reservas routes */

$router->get("back-reservas", "RegistraController", "index", [], "registra_index", "ROLE_ADMIN");

$router->post("registra", "RegistraController", "filterRegistra", [], "reservas_filter", "ROLE_ADMIN");

$router->get("reservas/create", "RegistraController", "createRegistra", ["id" => "number"], "reservas_create", "ROLE_USER");
$router->post("reservas/create", "RegistraController", "storeRegistra", [], "reservas_store", "ROLE_USER");
$router->get("movies/:id/edit", "MovieController", "edit", ["id" => "number"]);
$router->post("movies/:id/edit", "MovieController", "edit", ["id" => "number"]);
$router->get("registra/:id/show", "BackController", "show",
    ["id" => "number"], "usuarios_show");
$router->get("registra/:id/delete", "RegistraController", "deleteRegistra", ["id" => "number"],"reservas_delete", "ROLE_ADMIN");
$router->post("registra/delete", "RegistraController", "destroyRegistra", [], "reservas_destroy", "ROLE_ADMIN");
