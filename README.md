# Amazon Affiliate Tag Plugin

**Versión**: 1.1  
**Autor**: Joel Pérez Miralles

## Descripción
El plugin **Amazon Affiliate Tag** añade automáticamente el tag de afiliado a todos los enlaces salientes a Amazon.es y proporciona un shortcode para crear botones de compra.

## Características
- Añade automáticamente el tag de afiliado a todos los enlaces salientes a Amazon.es.
- Opción para añadir `rel="nofollow"` a los enlaces de Amazon.
- Opción para abrir los enlaces de Amazon en una nueva ventana (`target="_blank"`).
- Shortcode para crear botones de compra personalizados.

## Instalación
1. Descarga el plugin y sube los archivos a tu directorio de plugins de WordPress (`/wp-content/plugins/`).
2. Activa el plugin desde el menú de `Plugins` en WordPress.
3. Configura el plugin desde `Ajustes -> Amazon Affiliate Tag`.

## Uso
### Configuración del Plugin
1. Ve a `Ajustes -> Amazon Affiliate Tag`.
2. Introduce tu tag de afiliado de Amazon en el campo correspondiente.
3. Selecciona las opciones deseadas:
   - Añadir `rel="nofollow"` a los enlaces de Amazon.
   - Abrir los enlaces de Amazon en una nueva ventana.

### Shortcode para Botones de Amazon
Utiliza el siguiente shortcode para crear un botón de Amazon en tus publicaciones o páginas:

```html
[amazon_button url="https://www.amazon.es/dp/B08JG8J1LN" text="Comprar en Amazon"]
