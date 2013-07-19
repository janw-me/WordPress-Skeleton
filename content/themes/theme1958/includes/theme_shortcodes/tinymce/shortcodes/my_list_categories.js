frameworkShortcodeAtts={
	attributes:[
			{
				label:"Title",
				id:"title",
				help:"Title of the block"
			},
			{
				label:"Number of categories to display",
				id:"number"
			},
			{
				label:"Hide empty categories",
				id:"hide_empty",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true'
			},
			{
				label:"Sort categories by",
				id:"orderby",
				controlType:"select-control", 
				selectValues:['id', 'name', 'slug', 'count'],
				defaultValue: 'name', 
				defaultText: 'name'
			},
			{
				label:"Sort order for categories",
				id:"order",
				controlType:"select-control", 
				selectValues:['asc', 'desc'],
				defaultValue: 'asc', 
				defaultText: 'asc',
				help:"<b>asc</b> - ascending order, <b>desc</b> - descending order"
			},
			{
				label:"Include categories",
				id:"include",
				help:"Input a comma-separated list of categories by unique ID"
			},
			{
				label:"Exclude categories",
				id:"exclude",
				help:"Input a comma-separated list of categories by unique ID"
			},
			{
				label:"Custom class",
				id:"custom_class",
				help:"Use this field if you want to use a custom class for this block"
			}
	],
	defaultContent:"",
	shortcode:"list_categories"
};