[globalVar = TYPO3_LOADED_EXT|rtehtmlarea|type = S|L]
RTE.default {
	proc.allowedClasses := addToList(btn-default)
	FE.proc.link.properties.class.allowedClasses = btn-default
	FE.proc.page.properties.class.default = btn-default
	FE.buttons.link.page.properties.class.default = btn-default
	proc.link.properties.class.allowedClasses = btn-default
	proc.page.properties.class.default = btn-default
	buttons.link.page.properties.class.default = btn-default
}
[GLOBAL]

RTE.classesAnchor {
	dinnerclubButton {
		name = Dinnerclub Button
		class = btn-default
		type = page
	}
}
