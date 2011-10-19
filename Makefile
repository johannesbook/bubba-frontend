
all: help_texts generate_mo json

po_files = $(wildcard po/php/*.po po/js/*.po)
mo_files = $(patsubst %.po,%.mo,$(po_files))

VERSION=2.3

generate_mo: $(mo_files)

%.mo: %.po
	/usr/local/bin/msgfmt --output-file $@ --statistics --check $<

update_po: $(po_files)

$(po_files):
	msgmerge \
		--sort-output \
		--indent \
		--update \
		--verbose \
		--multi-domain \
		$@ \
		$(dir $@)bubba.pot

update_pot: po/php/bubba.pot po/js/bubba.pot

po/php/bubba.pot: $(shell cat po/php/POTFILES)
	./php-xgettext \
		--files-from=po/php/POTFILES \
		--default-domain=bubba \
		--output=$@ \
		--from-code=UTF-8 \
		--sort-output \
		--package-name=bubba-frontend \
		--package-version=$(VERSION) \
		--msgid-bugs-address=info@excito.com \
		--copyright-holder="Excito Electronics AB"

po/js/bubba.pot: $(shell cat po/js/POTFILES)
	xgettext \
		--language=JavaScript \
		--files-from=po/js/POTFILES \
		--default-domain=bubba \
		--output=$@ \
		--from-code=UTF-8 \
		--force-po \
		--sort-output \
		--package-name=bubba-frontend \
		--package-version=$(VERSION) \
		--msgid-bugs-address=info@excito.com \
		--copyright-holder="Excito Electronics AB"

help_texts: po4a.stamp

po4a.stamp: $(wildcard admin/views/default/help/en/*)
	po4a \
		--msgid-bugs-address=info@excito.com \
		--copyright-holder="Excito Electronics AB" \
		--package-name=bubba-frontend \
		--package-version=$(VERSION) \
		--master-charset=UTF-8 \
		--localized-charset=UTF-8 \
		--msgmerge-opt "--no-wrap" \
		--keep=40 \
		--rm-backups \
		po4a.conf
	@touch $@

json: $(wildcard po/js/*.po)
	$(foreach ll,$(basename $(notdir $^)),\
		./po2json \
		--pretty \
		--domain bubba \
		--output po/js/$(ll).json \
		--add-assign json_locale_data \
		po/js/$(ll).po \
		;\
	)

clean:
	rm -f po/php/*.mo po/js/*.mo
	rm -f po/js/*.json
	po4a \
		--msgid-bugs-address=info@excito.com \
		--copyright-holder="Excito Electronics AB" \
		--package-name=bubba-frontend \
		--package-version=$(VERSION) \
		--master-charset=UTF-8 \
		--localized-charset=UTF-8 \
		--msgmerge-opt "--no-wrap" \
		--keep=40 \
		--rm-backups \
		--rm-translations \
		po4a.conf
	rm -f po4a.stamp

locale_dir=$(DESTDIR)/usr/share/web-admin/admin/locale

install:
	$(foreach ll,$(basename $(notdir $(wildcard po/php/*.mo))),\
		install -m 0644 -D  po/php/$(ll).mo $(locale_dir)/$(ll)/LC_MESSAGES/bubba.mo;\
	)
	$(foreach ll,$(basename $(notdir $(wildcard po/js/*.mo))),\
		install -m 0644 -D  po/js/$(ll).json $(locale_dir)/$(ll)/LC_MESSAGES/bubba.json;\
	)

.PHONY: update_po update_pot help_texts all clean
