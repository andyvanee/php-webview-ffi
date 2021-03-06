#define WEBVIEW_IMPLEMENTATION
#include "webview.h"

struct webview* php_webview_new(const char* title, const char* url, int width,
                                int height, int debug, int resizable) {
  struct webview v = {
      .title = title,
      .url = url,
      .width = width,
      .height = height,
      .debug = debug,
      .resizable = resizable,
  };
  struct webview* ptr = malloc(sizeof(v));
  memcpy(ptr, &v, sizeof(v));
  return ptr;
}

void php_webview_free(struct webview* v) { free(v); }
