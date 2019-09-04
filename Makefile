CFLAGS ?= -std=c99 -Wall -Wextra -pedantic
WEBVIEW_CFLAGS := -c -fPIC -DWEBVIEW_GTK=1 $(shell pkg-config --cflags gtk+-3.0 webkit2gtk-4.0)
WEBVIEW_LDFLAGS := $(shell pkg-config --libs gtk+-3.0 webkit2gtk-4.0)

.PHONY: default
default: src/build/webview.so

src/build/%.o: src/%.c
	mkdir -p $(@D)
	$(CC) $(CFLAGS) $(WEBVIEW_CFLAGS) $? -o $@

src/build/webview.so: src/build/webview.o
	@mkdir -p $(@D)
	$(CC) -shared $? $(LDFLAGS) $(WEBVIEW_LDFLAGS) -o $@

clean:
	rm -rf src/build
