#define FFI_SCOPE "WEBVIEW"
#define FFI_LIB "build/webview.so"
#include <stdint.h>

// Added interface to support constructor/destructor
struct webview* php_webview_new(const char* title, const char* url, int width,
                                int height, int debug, int resizable);

void php_webview_free(struct webview*);

// Implemented webview interfaces
int webview_init(struct webview* w);

void webview_set_color(struct webview* w, uint8_t r, uint8_t g, uint8_t b,
                       uint8_t a);

int webview_eval(struct webview*, const char*);

int webview_inject_css(struct webview* w, const char* css);

void webview_set_title(struct webview* w, const char* title);

int webview_loop(struct webview*, int);

void webview_set_fullscreen(struct webview* w, int fullscreen);

void webview_exit(struct webview*);

void webview_terminate(struct webview*);
