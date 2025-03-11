<?php


// use App\Providers\ResourceStringProvider;


// /**
//  *
//  */
// return [
// 	/*
//      * ===========================================
//      * Provider Listing
//      * ===========================================
//      */
// 	'provider' => [
// 		'postType' => ['provider'],
// 		'defaultSort' => [
// 			'default' => 'rand',
// 			'fallback' => 'meta_value',
// 			'meta_key' => 'last_name',
// 		],
// 		'sortOptions' => [],
// 		'transform' => [
// 			'meta' => [
// 				'designation' => [
// 					'type' => 'field',
// 					'key' => 'designation',
// 					'returnAs' => 'string',
// 					'isRelational' => false,
// 				],
// 				'acceptingPatients' => [
// 					'type' => 'field',
// 					'key' => 'accepting_new_patients',
// 					'returnAs' => 'bool',
// 					'isRelational' => false,
// 				],
// 				'care_type' => [
// 					'type' => 'taxonomy',
// 					'key' => 'care_type',
// 				],
// 				'specialties' => [
// 					'type' => 'field',
// 					'key' => 'related_specialty',
// 					'returnAs' => [
// 						'title' => [
// 							'type' => 'post_object',
// 							'key' => 'post_title',
// 						],
// 					],
// 					'isRelational' => true,
// 				],
// 				'locations' => [
// 					'type' => 'field',
// 					'key' => 'related_location',
// 					'returnAs' => [
// 						'address' => [
// 							'type' => 'field',
// 							'key' => 'location_address_acf',
// 						]
// 					],
// 					'isRelational' => true,
// 				]
// 			],
// 		],
// 		'filterConfig' => [
// 			[
// 				'type' => 'checkbox',
// 				'label' => 'Accepting New Patients',
// 				'facetKey' => 'accepting_new_patients',
// 				'source' => 'field',
// 				'sourceKey' => 'accepting_new_patients',
// 				'hasAccordion' => false,
// 				'accordionState' => null,
// 				'showLabel' => false,
// 				'conditions' => [],
// 				'hasDynamicTerms' => false,
// 				'returnAs' => 'bool',
// 				'default' => '',
// 				'terms' => [
// 					[
// 						'label' => ResourceStringProvider::get('providers.listing.filters.accepting_new_patients', 'Accepting New Patients'),
// 						'value' => 'accepting_new_patients',
// 						'tooltip' => ResourceStringProvider::get('providers.listing.filters.accepting_new_patients.tooltip', ''),
// 						'resourceStringKey' => 'providers.listing.filters.accepting_new_patients',
// 					]
// 				]
// 			],
// 			[
// 				'type' => 'radio',
// 				'label' => 'Care Type',
// 				'facetKey' => 'care_type',
// 				'source' => 'taxonomy',
// 				'sourceKey' => 'care_type',
// 				'hasAccordion' => true,
// 				'accordionState' => 'open',
// 				'showLabel' => true,
// 				'conditions' => [],
// 				'hasDynamicTerms' => true,
// 				'default' => 'primary-care',
// 				'returnAs' => 'string',
// 				'terms' => []
// 			],
// 			[
// 				'type' => 'checkbox',
// 				'label' => 'Primary Care',
// 				'facetKey' => 'primary_care_type',
// 				'source' => 'taxonomy',
// 				'sourceKey' => 'primary_care_type',
// 				'hasAccordion' => true,
// 				'accordionState' => 'closed',
// 				'showLabel' => true,
// 				'returnAs' => 'array',
// 				'default' => '',
// 				'conditions' => [
// 					[
// 						'facet' => 'care_type',
// 						'operator' => 'equals', // === | !== | includes
// 						'term' => 'primary-care',
// 						'action' => 'show', // show | hide
// 					],
// 					[
// 						'facet' => 'care_type',
// 						'operator' => 'equals', // === | !== | includes
// 						'term' => 'specialty-care',
// 						'action' => 'hide', // show | hide
// 					]
// 				],
// 				'hasDynamicTerms' => true,
// 				'terms' => []
// 			],
// 			[
// 				'type' => 'radio',
// 				'label' => 'Specialties',
// 				'facetKey' => 'specialty_care_type',
// 				'source' => 'taxonomy',
// 				'sourceKey' => 'specialty_care_type',
// 				'hasAccordion' => true,
// 				'accordionState' => 'closed',
// 				'showLabel' => true,
// 				'returnAs' => 'string',
// 				'default' => '',
// 				'conditions' => [
// 					[
// 						'facet' => 'care_type',
// 						'operator' => 'equals', // === | !== | includes
// 						'term' => 'primary-care',
// 						'action' => 'hide', // show | hide
// 					],
// 					[
// 						'facet' => 'care_type',
// 						'operator' => 'equals', // === | !== | includes
// 						'term' => 'specialty-care',
// 						'action' => 'show', // show | hide
// 					]
// 				],
// 				'hasDynamicTerms' => true,
// 				'terms' => []
// 			],
// 			[
// 				'type' => 'checkbox',
// 				'label' => 'Gender',
// 				'facetKey' => 'gender',
// 				'source' => 'field',
// 				'sourceKey' => 'field_66a19ce592811',
// 				'hasAccordion' => true,
// 				'accordionState' => 'closed',
// 				'showLabel' => true,
// 				'conditions' => [],
// 				'returnAs' => 'array',
// 				'default' => '',
// 				'hasDynamicTerms' => true,
// 				'terms' => []
// 			],
// 		],
// 		'strings' => [],
// 	],

// 	/*
//      * ===========================================
//      * Location Listing
//      * ===========================================
//      */
// 	'location' => [
// 		'postType' => ['location', 'practice'],
// 		'defaultSort' => [
// 			'default' => 'title',
// 		],
// 		'sortOptions' => [],
// 		'transform' => [
// 			'meta' => [
// 				'phone' => [
// 					'type' => 'field',
// 					'key' => 'location_phone',
// 				],
// 				'address' => [
// 					'type' => 'field',
// 					'key' => 'location_address_acf',
// 				],
// 			]
// 		],
// 		'filterConfig' => [
// 			[
// 				'type' => 'checkbox',
// 				'label' => 'Location Type',
// 				'facetKey' => 'location_type',
// 				'source' => 'taxonomy',
// 				'sourceKey' => 'location_type',
// 				'hasAccordion' => true,
// 				'accordionState' => 'open',
// 				'showLabel' => true,
// 				'conditions' => [],
// 				'hasDynamicTerms' => true,
// 				'default' => '',
// 				'returnAs' => 'array',
// 				'terms' => []
// 			],
// 		]
// 	],

// 	/*
//      * ===========================================
//      * Posts (articles) Listing
//      * ===========================================
//      */
// 	'post' => [
// 		'postType' => ['post'],
// 		'defaultSort' => [
// 			'default' => 'relevance',
// 		],
// 		'sortOptions' => [
// 			[
// 				'value' => 'title',
// 				'label' => 'Sort by alphabetical',
// 			],
// 			[
// 				'value' => 'relevance',
// 				'label' => 'Sort by best match',
// 				'default' => true,
// 			]
// 		],
// 		'transform' => [
// 			'meta' => [
// 				'post_tag' => [
// 					'type' => 'taxonomy',
// 					'key' => 'post_tag',
// 				],
// 			]
// 		],
// 		'filterConfig' => [
// 			[
// 				'type' => 'checkbox',
// 				'label' => 'Tags',
// 				'facetKey' => 'post_tag',
// 				'source' => 'taxonomy',
// 				'sourceKey' => 'post_tag',
// 				'hasAccordion' => true,
// 				'accordionState' => 'open',
// 				'showLabel' => true,
// 				'returnAs' => 'array',
// 				'default' => '',
// 				'conditions' => [],
// 				'hasDynamicTerms' => true,
// 				'terms' => []
// 			]
// 		]
// 	],

// 	/*
//      * ===========================================
//      * Global Search
//      * ===========================================
//      */
// 	'global' => [
// 		'postType' => ['post', 'page', 'location', 'practice', 'provider', 'service', 'specialty'],
// 		'defaultSort' => [
// 			'default' => 'relevance',
// 		],
// 		'sortOptions' => [
// 			[
// 				'value' => 'title',
// 				'label' => 'Sort by alphabetical',
// 			],
// 			[
// 				'value' => 'relevance',
// 				'label' => 'Sort by best match',
// 				'default' => true,
// 			]
// 		],
// 		'transform' => [
// 			'meta' => [
// 				'post_tag' => [
// 					'type' => 'taxonomy',
// 					'key' => 'post_tag',
// 				],
// 			]
// 		],
// 		'filterConfig' => [
// 			[
// 				'type' => 'button',
// 				'label' => 'Content type',
// 				'facetKey' => 'post_type',
// 				'source' => 'post_type',
// 				'sourceKey' => 'post_type',
// 				'hasAccordion' => false,
// 				'accordionState' => 'open',
// 				'showLabel' => false,
// 				'returnAs' => 'array',
// 				'default' => 'post,location,practice,page,provider,service,specialty',
// 				'conditions' => [],
// 				'hasDynamicTerms' => false,
// 				'terms' => [
// 					[
// 						'label' => 'All Search Results',
// 						'value' => 'post,location,practice,page,provider,service,specialty',
// 						'tooltip' => '',
// 						'resourceStringKey' => '',
// 					],
// 					[
// 						'label' => 'Articles',
// 						'value' => 'post',
// 						'tooltip' => '',
// 						'resourceStringKey' => '',
// 					],
// 					[
// 						'label' => 'Locations',
// 						'value' => 'location,practice',
// 						'tooltip' => '',
// 						'resourceStringKey' => '',
// 					],
// 					[
// 						'label' => 'Pages',
// 						'value' => 'page',
// 						'tooltip' => '',
// 						'resourceStringKey' => '',
// 					],
// 					[
// 						'label' => 'Providers',
// 						'value' => 'provider',
// 						'tooltip' => '',
// 						'resourceStringKey' => '',
// 					],
// 					[
// 						'label' => 'Services',
// 						'value' => 'service',
// 						'tooltip' => '',
// 						'resourceStringKey' => '',
// 					],
// 					[
// 						'label' => 'Specialties',
// 						'value' => 'specialty',
// 						'tooltip' => '',
// 						'resourceStringKey' => '',
// 					]
// 				]
// 			]
// 		]
// 	],

// ];
