tx_news.templateLayouts {
	53 =  --div--,Dinnerclub
	54 = Startansicht
	55 = Registration
	56 = Detailansicht ohne Registration
	57 = Detailansicht mit Anmeldungen
	58 = Ab-/Ummeldungsformular
}

TCEFORM.tx_news_domain_model_news {
	// Add type selector with icon
	type {
		addItems {
			60 = Dinnerclub event
			60.icon = dinnerclub
		}
	}

	# General
	istopnews.types.60.disabled = 1
	sys_language_uid.types.60.disabled = 1
	author.types.60.disabled = 1
	author_email.types.60.disabled = 1
	archive.types.60.disabled = 1

	# Access
	starttime.types.60.disabled = 1
	endtime.types.60.disabled = 1
	fe_group.types.60.disabled = 1
	editlock.types.60.disabled = 1

	# Options
	categories.types.60.disabled = 1
	tags.types.60.disabled = 1

	# Relations
	fal_media.types.60 {
		label = Bild
		disabled = 0
	}
	fal_related_files.types.60.disabled = 1
	related_links.types.60.disabled = 1
	related.types.60.disabled = 1
	related_from.types.60.disabled = 1

	# Metadata
	keywords.types.60.disabled = 1
	description.types.60.disabled = 1
	alternative_title.types.60.disabled = 1
	path_segment.types.60.disabled = 1

	# Notes: is not an excludefield!
	notes.types.60.disabled = 1
}
