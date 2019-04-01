<?php        
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */ 

function optionsframework_option_name() {
	// Change this to use your theme slug
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	return $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'massage-spa-pro'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
*/

function optionsframework_options() {
	//array of all custom font types.
	$font_types = array( '' => '',
    'ABeeZee' => 'ABeeZee',
    'Abel' => 'Abel',
    'Abril Fatface' => 'Abril Fatface',
    'Aclonica' => 'Aclonica',
    'Acme' => 'Acme',
    'Actor' => 'Actor',
    'Adamina' => 'Adamina',
    'Advent Pro' => 'Advent Pro',
    'Aguafina Script' => 'Aguafina Script',
    'Akronim' => 'Akronim',
    'Aladin' => 'Aladin',
    'Aldrich' => 'Aldrich',
    'Alegreya' => 'Alegreya',
    'Alegreya Sans SC' => 'Alegreya Sans SC',
    'Alegreya SC' => 'Alegreya SC',
    'Alex Brush' => 'Alex Brush',
    'Alef' => 'Alef',
    'Alfa Slab One' => 'Alfa Slab One',
    'Alice' => 'Alice',
    'Alike' => 'Alike',
    'Alike Angular' => 'Alike Angular',
    'Allan' => 'Allan',
    'Allerta' => 'Allerta',
    'Allerta Stencil' => 'Allerta Stencil',
    'Allura' => 'Allura',
    'Almendra' => 'Almendra',
    'Almendra Display' => 'Almendra Display',
    'Almendra SC' => 'Almendra SC',
    'Amiri' => 'Amiri',
    'Amarante' => 'Amarante',
    'Amaranth' => 'Amaranth',
    'Amatic SC' => 'Amatic SC',
    'Amethysta' => 'Amethysta',
    'Amita' => 'Amita',
    'Anaheim' => 'Anaheim',
    'Andada' => 'Andada',
    'Andika' => 'Andika',
    'Annie Use Your Telescope' => 'Annie Use Your Telescope',
    'Anonymous Pro' => 'Anonymous Pro',
    'Antic' => 'Antic',
    'Antic Didone' => 'Antic Didone',
    'Antic Slab' => 'Antic Slab',
    'Anton' => 'Anton',
    'Angkor' => 'Angkor',
    'Arapey' => 'Arapey',
    'Arbutus' => 'Arbutus',
    'Arbutus Slab' => 'Arbutus Slab',
    'Architects Daughter' => 'Architects Daughter',
    'Archivo White' => 'Archivo White',
    'Archivo Narrow' => 'Archivo Narrow',
    'Arial' => 'Arial',
    'Arimo' => 'Arimo',
    'Arya' => 'Arya',
    'Arizonia' => 'Arizonia',
    'Armata' => 'Armata',
    'Artifika' => 'Artifika',
    'Arvo' => 'Arvo',
    'Asar' => 'Asar',
    'Asap' => 'Asap',
    'Asset' => 'Asset',
    'Astloch' => 'Astloch',
    'Asul' => 'Asul',
    'Atomic Age' => 'Atomic Age',
    'Aubrey' => 'Aubrey',
    'Audiowide' => 'Audiowide',
    'Autour One' => 'Autour One',
    'Average' => 'Average',
    'Average Sans' => 'Average Sans',
    'Averia Gruesa Libre' => 'Averia Gruesa Libre',
    'Averia Libre' => 'Averia Libre',
    'Averia Sans Libre' => 'Averia Sans Libre',
    'Averia Serif Libre' => 'Averia Serif Libre',
    'Battambang' => 'Battambang',
    'Bad Script' => 'Bad Script',
    'Bayon' => 'Bayon',
    'Balthazar' => 'Balthazar',
    'Bangers' => 'Bangers',
    'Basic' => 'Basic',
    'Baumans' => 'Baumans',
    'Belgrano' => 'Belgrano',
    'Belleza' => 'Belleza',
    'BenchNine' => 'BenchNine',
    'Bentham' => 'Bentham',
    'Berkshire Swash' => 'Berkshire Swash',
    'Bevan' => 'Bevan',
    'Bigelow Rules' => 'Bigelow Rules',
    'Bigshot One' => 'Bigshot One',
    'Bilbo' => 'Bilbo',
    'Bilbo Swash Caps' => 'Bilbo Swash Caps',
    'Biryani' => 'Biryani',
    'Bitter' => 'Bitter',
    'White Ops One' => 'White Ops One',
    'Bokor' => 'Bokor',
    'Bonbon' => 'Bonbon',
    'Boogaloo' => 'Boogaloo',
    'Bowlby One' => 'Bowlby One',
    'Bowlby One SC' => 'Bowlby One SC',
    'Brawler' => 'Brawler',
    'Bree Serif' => 'Bree Serif',
    'Bubblegum Sans' => 'Bubblegum Sans',
    'Bubbler One' => 'Bubbler One',
    'Buda' => 'Buda',
    'Buenard' => 'Buenard',
    'Butcherman' => 'Butcherman',
    'Butcherman Caps' => 'Butcherman Caps',
    'Butterfly Kids' => 'Butterfly Kids',
    'Cabin' => 'Cabin',
    'Cabin Condensed' => 'Cabin Condensed',
    'Cabin Sketch' => 'Cabin Sketch',
    'Cabin' => 'Cabin',
    'Caesar Dressing' => 'Caesar Dressing',
    'Cagliostro' => 'Cagliostro',
    'Calligraffitti' => 'Calligraffitti',
    'Cambay' => 'Cambay',
    'Cambo' => 'Cambo',
    'Candal' => 'Candal',
    'Cantarell' => 'Cantarell',
    'Cantata One' => 'Cantata One',
    'Cantora One' => 'Cantora One',
    'Capriola' => 'Capriola',
    'Cardo' => 'Cardo',
    'Carme' => 'Carme',
    'Carrois Gothic' => 'Carrois Gothic',
    'Carrois Gothic SC' => 'Carrois Gothic SC',
    'Carter One' => 'Carter One',
    'Caveat' => 'Caveat',
    'Caveat Brush' => 'Caveat Brush',
    'Catamaran' => 'Catamaran',
    'Caudex' => 'Caudex',
    'Cedarville Cursive' => 'Cedarville Cursive',
    'Ceviche One' => 'Ceviche One',
    'Changa One' => 'Changa One',
    'Chango' => 'Chango',
    'Chau Philomene One' => 'Chau Philomene One',
    'Chenla' => 'Chenla',
    'Chela One' => 'Chela One',
    'Chelsea Market' => 'Chelsea Market',
    'Cherry Cream Soda' => 'Cherry Cream Soda',
    'Cherry Swash' => 'Cherry Swash',
    'Chewy' => 'Chewy',
    'Chicle' => 'Chicle',
    'Chivo' => 'Chivo',
    'Chonburi' => 'Chonburi',
    'Cinzel' => 'Cinzel',
    'Cinzel Decorative' => 'Cinzel Decorative',
    'Clicker Script' => 'Clicker Script',
    'Coda' => 'Coda',
    'Codystar' => 'Codystar',
    'Combo' => 'Combo',
    'Comfortaa' => 'Comfortaa',
    'Coming Soon' => 'Coming Soon',
    'Condiment' => 'Condiment',
    'Content' => 'Content',
    'Contrail One' => 'Contrail One',
    'Convergence' => 'Convergence',
    'Cookie' => 'Cookie',
    'Comic Sans MS' => 'Comic Sans MS',
    'Copse' => 'Copse',
    'Corben' => 'Corben',
    'Courgette' => 'Courgette',
    'Cousine' => 'Cousine',
    'Coustard' => 'Coustard',
    'Covered By Your Grace' => 'Covered By Your Grace',
    'Crafty Girls' => 'Crafty Girls',
    'Creepster' => 'Creepster',
    'Creepster Caps' => 'Creepster Caps',
    'Crete Round' => 'Crete Round',
    'Crimson' => 'Crimson',
    'Croissant One' => 'Croissant One',
    'Crushed' => 'Crushed',
    'Cuprum' => 'Cuprum',
    'Cutive' => 'Cutive',
    'Cutive Mono' => 'Cutive Mono',
    'Damion' => 'Damion',
    'Dangrek' => 'Dangrek',
    'Dancing Script' => 'Dancing Script',
    'Dawning of a New Day' => 'Dawning of a New Day',
    'Days One' => 'Days One',
    'Dekko' => 'Dekko',
    'Delius' => 'Delius',
    'Delius Swash Caps' => 'Delius Swash Caps',
    'Delius Unicase' => 'Delius Unicase',
    'Della Respira' => 'Della Respira',
    'Denk One' => 'Denk One',
    'Devonshire' => 'Devonshire',
    'Dhurjati' => 'Dhurjati',
    'Didact Gothic' => 'Didact Gothic',
    'Diplomata' => 'Diplomata',
    'Diplomata SC' => 'Diplomata SC',
    'Domine' => 'Domine',
    'Donegal One' => 'Donegal One',
    'Doppio One' => 'Doppio One',
    'Dorsa' => 'Dorsa',
    'Dosis' => 'Dosis',
    'Dr Sugiyama' => 'Dr Sugiyama',
    'Droid Sans' => 'Droid Sans',
    'Droid Sans Mono' => 'Droid Sans Mono',
    'Droid Serif' => 'Droid Serif',
    'Duru Sans' => 'Duru Sans',
    'Dynalight' => 'Dynalight',
    'EB Garamond' => 'EB Garamond',
    'Eczar' => 'Eczar',
    'Eagle Lake' => 'Eagle Lake',
    'Eater' => 'Eater',
    'Eater Caps' => 'Eater Caps',
    'Economica' => 'Economica',
    'Ek Mukta' => 'Ek Mukta',
    'Electrolize' => 'Electrolize',
    'Elsie' => 'Elsie',
    'Elsie Swash Caps' => 'Elsie Swash Caps',
    'Emblema One' => 'Emblema One',
    'Emilys Candy' => 'Emilys Candy',
    'Engagement' => 'Engagement',
    'Englebert' => 'Englebert',
    'Enriqueta' => 'Enriqueta',
    'Erica One' => 'Erica One',
    'Esteban' => 'Esteban',
    'Euphoria Script' => 'Euphoria Script',
    'Ewert' => 'Ewert',
    'Exo' => 'Exo',
    'Exo 2' => 'Exo 2',
    'Expletus Sans' => 'Expletus Sans',
    'Fanwood Text' => 'Fanwood Text',
    'Fascinate' => 'Fascinate',
    'Fascinate Inline' => 'Fascinate Inline',
    'Fasthand' => 'Fasthand',
    'Faster One' => 'Faster One',
    'Federant' => 'Federant',
    'Federo' => 'Federo',
    'Felipa' => 'Felipa',
    'Fenix' => 'Fenix',
    'Finger Paint' => 'Finger Paint',
    'Fira Mono' => 'Fira Mono',
    'Fira Sans' => 'Fira Sans',
    'Fjalla One' => 'Fjalla One',
    'Fjord One' => 'Fjord One',
    'Flamenco' => 'Flamenco',
    'Flavors' => 'Flavors',
    'Fondamento' => 'Fondamento',
    'Fontdiner Swanky' => 'Fontdiner Swanky',
    'Forum' => 'Forum',
    'Francois One' => 'Francois One',
    'FreeSans' => 'FreeSans',

    'Freckle Face' => 'Freckle Face',
    'Fredericka the Great' => 'Fredericka the Great',
    'Fredoka One' => 'Fredoka One',
    'Fresca' => 'Fresca',
    'Freehand' => 'Freehand',
    'Frijole' => 'Frijole',
    'Fruktur' => 'Fruktur',
    'Fugaz One' => 'Fugaz One',
    'Gafata' => 'Gafata',
    'Galdeano' => 'Galdeano',
    'Galindo' => 'Galindo',
    'Gentium Basic' => 'Gentium Basic',
    'Gentium Book Basic' => 'Gentium Book Basic',
    'Geo' => 'Geo',
    'Georgia' => 'Georgia',
    'Geostar' => 'Geostar',
    'Geostar Fill' => 'Geostar Fill',
    'Germania One' => 'Germania One',
    'Gilda Display' => 'Gilda Display',
    'Give You Glory' => 'Give You Glory',
    'Glass Antiqua' => 'Glass Antiqua',
    'Glegoo' => 'Glegoo',
    'Gloria Hallelujah' => 'Gloria Hallelujah',
    'Goblin One' => 'Goblin One',
    'Gochi Hand' => 'Gochi Hand',
    'Gorditas' => 'Gorditas',
    'Gurajada' => 'Gurajada',
    'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
    'Graduate' => 'Graduate',
    'Grand Hotel' => 'Grand Hotel',
    'Gravitas One' => 'Gravitas One',
    'Great Vibes' => 'Great Vibes',
    'Griffy' => 'Griffy',
    'Gruppo' => 'Gruppo',
    'Gudea' => 'Gudea',
    'Gidugu' => 'Gidugu',
    'GFS Didot' => 'GFS Didot',
    'GFS Neohellenic' => 'GFS Neohellenic',
    'Habibi' => 'Habibi',
    'Hammersmith One' => 'Hammersmith One',
    'Halant' => 'Halant',
    'Hanalei' => 'Hanalei',
    'Hanalei Fill' => 'Hanalei Fill',
    'Handlee' => 'Handlee',
    'Hanuman' => 'Hanuman',
    'Happy Monkey' => 'Happy Monkey',
    'Headland One' => 'Headland One',
    'Henny Penny' => 'Henny Penny',
    'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
    'Hind' => 'Hind',
    'Hind Siliguri' => 'Hind Siliguri',
    'Hind Vadodara' => 'Hind Vadodara',
    'Holtwood One SC' => 'Holtwood One SC',
    'Homemade Apple' => 'Homemade Apple',
    'Homenaje' => 'Homenaje',
    'IM Fell' => 'IM Fell',
    'Itim' => 'Itim',
    'Iceberg' => 'Iceberg',
    'Iceland' => 'Iceland',
    'Imprima' => 'Imprima',
    'Inconsolata' => 'Inconsolata',
    'Inder' => 'Inder',
    'Indie Flower' => 'Indie Flower',
    'Inknut Antiqua' => 'Inknut Antiqua',
    'Inika' => 'Inika',
    'Irish Growler' => 'Irish Growler',
    'Istok Web' => 'Istok Web',
    'Italiana' => 'Italiana',
    'Italianno' => 'Italianno',
    'Jacques Francois' => 'Jacques Francois',
    'Jacques Francois Shadow' => 'Jacques Francois Shadow',
    'Jim Nightshade' => 'Jim Nightshade',
    'Jockey One' => 'Jockey One',
    'Jaldi' => 'Jaldi',
    'Jolly Lodger' => 'Jolly Lodger',
    'Josefin Sans' => 'Josefin Sans',
    'Josefin Sans' => 'Josefin Sans',
    'Josefin Slab' => 'Josefin Slab',
    'Joti One' => 'Joti One',
    'Judson' => 'Judson',
    'Julee' => 'Julee',
    'Julius Sans One' => 'Julius Sans One',
    'Junge' => 'Junge',
    'Jura' => 'Jura',
    'Just Another Hand' => 'Just Another Hand',
    'Just Me Again Down Here' => 'Just Me Again Down Here',
    'Kadwa' => 'Kadwa',
    'Kdam Thmor' => 'Kdam Thmor',
    'Kalam' => 'Kalam', 
    'Kameron' => 'Kameron',
    'Kantumruy' => 'Kantumruy',
    'Karma' => 'Karma',
    'Karla' => 'Karla',
    'Kaushan Script' => 'Kaushan Script',
    'Kavoon' => 'Kavoon',
    'Keania One' => 'Keania One',
    'Kelly Slab' => 'Kelly Slab',
    'Kenia' => 'Kenia',
    'Khand' => 'Khand',
    'Khmer' => 'Khmer',
    'Khula' => 'Khula',
    'Kite One' => 'Kite One',
    'Knewave' => 'Knewave',
    'Kotta One' => 'Kotta One',
    'Kranky' => 'Kranky',
    'Kreon' => 'Kreon',
    'Kristi' => 'Kristi',
    'Koulen' => 'Koulen',
    'Krona One' => 'Krona One',
    'Kurale' => 'Kurale',
    'Lakki Reddy' => 'Lakki Reddy',
    'La Belle Aurore' => 'La Belle Aurore',
    'Lancelot' => 'Lancelot',
    'Laila' => 'Laila',
    'Lato' => 'Lato',
    'Lateef' => 'Lateef',
    'League Script' => 'League Script',
    'Leckerli One' => 'Leckerli One',
    'Ledger' => 'Ledger',
    'Lekton' => 'Lekton',
    'Lemon' => 'Lemon',
    'Libre Baskerville' => 'Libre Baskerville',
    'Life Savers' => 'Life Savers',
    'Lilita One' => 'Lilita One',
    'Limelight' => 'Limelight',
    'Linden Hill' => 'Linden Hill',
    'Lobster' => 'Lobster',
    'Lobster Two' => 'Lobster Two',
    'Londrina Outline' => 'Londrina Outline',
    'Londrina Shadow' => 'Londrina Shadow',
    'Londrina Sketch' => 'Londrina Sketch',
    'Londrina Solid' => 'Londrina Solid',
    'Lora' => 'Lora',
    'Love Ya Like A Sister' => 'Love Ya Like A Sister',
    'Loved by the King' => 'Loved by the King',
    'Lovers Quarrel' => 'Lovers Quarrel',
    'Lucida Sans Unicode' => 'Lucida Sans Unicode',
    'Luckiest Guy' => 'Luckiest Guy',
    'Lusitana' => 'Lusitana',
    'Lustria' => 'Lustria',
    'Macondo' => 'Macondo',
    'Macondo Swash Caps' => 'Macondo Swash Caps',
    'Magra' => 'Magra',
    'Maiden Orange' => 'Maiden Orange',
    'Mallanna' => 'Mallanna',
    'Mandali' => 'Mandali',
    'Mako' => 'Mako',
    'Marcellus' => 'Marcellus',
    'Marcellus SC' => 'Marcellus SC',
    'Marck Script' => 'Marck Script',
    'Margarine' => 'Margarine',
    'Marko One' => 'Marko One',
    'Marmelad' => 'Marmelad',
    'Marvel' => 'Marvel',
    'Martel' => 'Martel',
    'Martel Sans' => 'Martel Sans',
    'Mate' => 'Mate',
    'Mate SC' => 'Mate SC',
    'Maven Pro' => 'Maven Pro',
    'McLaren' => 'McLaren',
    'Meddon' => 'Meddon',
    'MedievalSharp' => 'MedievalSharp',
    'Medula One' => 'Medula One',
    'Megrim' => 'Megrim',
    'Meie Script' => 'Meie Script',
    'Merienda' => 'Merienda',
    'Merienda One' => 'Merienda One',
    'Merriweather' => 'Merriweather',
    'Metal' => 'Metal',
    'Metal Mania' => 'Metal Mania',
    'Metamorphous' => 'Metamorphous',
    'Metrophobic' => 'Metrophobic',
    'Michroma' => 'Michroma',
    'Milonga' => 'Milonga',
    'Miltonian' => 'Miltonian',
    'Miltonian Tattoo' => 'Miltonian Tattoo',
    'Miniver' => 'Miniver',
    'Miss Fajardose' => 'Miss Fajardose',
    'Miss Saint Delafield' => 'Miss Saint Delafield',
    'Modak' => 'Modak',
    'Modern Antiqua' => 'Modern Antiqua',
    'Molengo' => 'Molengo',
    'Molle' => 'Molle',
    'Moulpali' => 'Moulpali',
    'Monda' => 'Monda',
    'Monofett' => 'Monofett',
    'Monoton' => 'Monoton',
    'Monsieur La Doulaise' => 'Monsieur La Doulaise',
    'Montaga' => 'Montaga',
    'Montez' => 'Montez',
    'Montserrat' => 'Montserrat',
    'Montserrat Alternates' => 'Montserrat Alternates',
    'Montserrat Subrayada' => 'Montserrat Subrayada',
    'Mountains of Christmas' => 'Mountains of Christmas',
    'Mouse Memoirs' => 'Mouse Memoirs',
    'Moul' => 'Moul',
    'Mr Bedford' => 'Mr Bedford',
    'Mr Bedfort' => 'Mr Bedfort',
    'Mr Dafoe' => 'Mr Dafoe',
    'Mr De Haviland' => 'Mr De Haviland',
    'Mrs Saint Delafield' => 'Mrs Saint Delafield',
    'Mrs Sheppards' => 'Mrs Sheppards',
    'Muli' => 'Muli',
    'Mystery Quest' => 'Mystery Quest',
    'Neucha' => 'Neucha',
    'Neuton' => 'Neuton',
    'New Rocker' => 'New Rocker',
    'News Cycle' => 'News Cycle',
    'Niconne' => 'Niconne',
    'Nixie One' => 'Nixie One',
    'Nobile' => 'Nobile',
    'Nokora' => 'Nokora',
    'Norican' => 'Norican',
    'Nosifer' => 'Nosifer',
    'Nosifer Caps' => 'Nosifer Caps',
    'Nova Mono' => 'Nova Mono',
    'Noticia Text' => 'Noticia Text',
    'Noto Sans' => 'Noto Sans',
    'Noto Serif' => 'Noto Serif',
    'Nova Round' => 'Nova Round',
    'Numans' => 'Numans',
    'Nunito' => 'Nunito',
    'NTR' => 'NTR',
    'Offside' => 'Offside',
    'Oldenburg' => 'Oldenburg',
    'Oleo Script' => 'Oleo Script',
    'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
    'Open Sans' => 'Open Sans',
    'Open Sans Condensed' => 'Open Sans Condensed',
    'Oranienbaum' => 'Oranienbaum',
    'Orbitron' => 'Orbitron',
    'Odor Mean Chey' => 'Odor Mean Chey',
    'Oregano' => 'Oregano',
    'Orienta' => 'Orienta',
    'Original Surfer' => 'Original Surfer',
    'Oswald' => 'Oswald',
    'Over the Rainbow' => 'Over the Rainbow',
    'Overlock' => 'Overlock',
    'Overlock SC' => 'Overlock SC',
    'Ovo' => 'Ovo',
    'Oxygen' => 'Oxygen',
    'Oxygen Mono' => 'Oxygen Mono',
    'Palanquin Dark' => 'Palanquin Dark',
    'Peddana' => 'Peddana',
    'Poppins' => 'Poppins',
    'PT Mono' => 'PT Mono',
    'PT Sans' => 'PT Sans',
    'PT Sans Caption' => 'PT Sans Caption',
    'PT Sans Narrow' => 'PT Sans Narrow',
    'PT Serif' => 'PT Serif',
    'PT Serif Caption' => 'PT Serif Caption',
    'Pacifico' => 'Pacifico',
    'Paprika' => 'Paprika',
    'Parisienne' => 'Parisienne',
    'Passero One' => 'Passero One',
    'Passion One' => 'Passion One',
    'Patrick Hand' => 'Patrick Hand',
    'Patrick Hand SC' => 'Patrick Hand SC',
    'Patua One' => 'Patua One',
    'Paytone One' => 'Paytone One',
    'Peralta' => 'Peralta',
    'Permanent Marker' => 'Permanent Marker',
    'Petit Formal Script' => 'Petit Formal Script',
    'Petrona' => 'Petrona',
    'Philosopher' => 'Philosopher',
    'Piedra' => 'Piedra',
    'Pinyon Script' => 'Pinyon Script',
    'Pirata One' => 'Pirata One',
    'Plaster' => 'Plaster',
    'Palatino Linotype' => 'Palatino Linotype',
    'Play' => 'Play',
    'Playball' => 'Playball',
    'Playfair Display' => 'Playfair Display',
    'Playfair Display SC' => 'Playfair Display SC',
    'Podkova' => 'Podkova',
    'Poiret One' => 'Poiret One',
    'Poller One' => 'Poller One',
    'Poly' => 'Poly',
    'Pompiere' => 'Pompiere',
    'Pontano Sans' => 'Pontano Sans',
    'Port Lligat Sans' => 'Port Lligat Sans',
    'Port Lligat Slab' => 'Port Lligat Slab',
    'Prata' => 'Prata',
    'Pragati Narrow' => 'Pragati Narrow',
    'Preahvihear' => 'Preahvihear',
    'Press Start 2P' => 'Press Start 2P',
    'Princess Sofia' => 'Princess Sofia',
    'Prociono' => 'Prociono',
    'Prosto One' => 'Prosto One',
    'Puritan' => 'Puritan',
    'Purple Purse' => 'Purple Purse',
    'Quando' => 'Quando',
    'Quantico' => 'Quantico',
    'Quattrocento' => 'Quattrocento',
    'Quattrocento Sans' => 'Quattrocento Sans',
    'Questrial' => 'Questrial',
    'Quicksand' => 'Quicksand',
    'Quintessential' => 'Quintessential',
    'Qwigley' => 'Qwigley',
    'Racing Sans One' => 'Racing Sans One',
    'Radley' => 'Radley',
    'Rajdhani' => 'Rajdhani',
    'Raleway Dots' => 'Raleway Dots',
    'Raleway' => 'Raleway',
    'Rambla' => 'Rambla',
    'Ramabhadra' => 'Ramabhadra',
    'Ramaraja' => 'Ramaraja',
    'Rammetto One' => 'Rammetto One',
    'Ranchers' => 'Ranchers',
    'Rancho' => 'Rancho',
    'Ranga' => 'Ranga',
    'Ravi Prakash' => 'Ravi Prakash',
    'Rationale' => 'Rationale',
    'Redressed' => 'Redressed',
    'Reenie Beanie' => 'Reenie Beanie',
    'Revalia' => 'Revalia',
    'Rhodium Libre' => 'Rhodium Libre',
    'Ribeye' => 'Ribeye',
    'Ribeye Marrow' => 'Ribeye Marrow',
    'Righteous' => 'Righteous',
    'Risque' => 'Risque',
    'Roboto' => 'Roboto',
    'Roboto Condensed' => 'Roboto Condensed',
    'Roboto Mono' => 'Roboto Mono',
    'Roboto Slab' => 'Roboto Slab',
    'Rochester' => 'Rochester',
    'Rock Salt' => 'Rock Salt',
    'Rokkitt' => 'Rokkitt',
    'Romanesco' => 'Romanesco',
    'Ropa Sans' => 'Ropa Sans',
    'Rosario' => 'Rosario',
    'Rosarivo' => 'Rosarivo',
    'Rouge Script' => 'Rouge Script',
    'Rozha One' => 'Rozha One',
    'Rubik' => 'Rubik',
    'Rubik One' => 'Rubik One',
    'Rubik Mono One' => 'Rubik Mono One',
    'Ruda' => 'Ruda',
    'Rufina' => 'Rufina',
    'Ruge Boogie' => 'Ruge Boogie',
    'Ruluko' => 'Ruluko',
    'Rum Raisin' => 'Rum Raisin',
    'Ruslan Display' => 'Ruslan Display',
    'Russo One' => 'Russo One',
    'Ruthie' => 'Ruthie',
    'Rye' => 'Rye',
    'Sacramento' => 'Sacramento',
    'Sail' => 'Sail',
    'Salsa' => 'Salsa',
    'Sanchez' => 'Sanchez',
    'Sancreek' => 'Sancreek',
    'Sahitya' => 'Sahitya',
    'Sansita One' => 'Sansita One',
    'Sarpanch' => 'Sarpanch',
    'Sarina' => 'Sarina',
    'Satisfy' => 'Satisfy',
    'Scada' => 'Scada',
    'Scheherazade' => 'Scheherazade',
    'Schoolbell' => 'Schoolbell',
    'Seaweed Script' => 'Seaweed Script',
    'Sarala' => 'Sarala',
    'Sevillana' => 'Sevillana',
    'Seymour One' => 'Seymour One',
    'Shadows Into Light' => 'Shadows Into Light',
    'Shadows Into Light Two' => 'Shadows Into Light Two',
    'Shanti' => 'Shanti',
    'Share' => 'Share',
    'Share Tech' => 'Share Tech',
    'Share Tech Mono' => 'Share Tech Mono',
    'Shojumaru' => 'Shojumaru',
    'Short Stack' => 'Short Stack',
    'Sigmar One' => 'Sigmar One',
    'Suranna' => 'Suranna',
    'Suravaram' => 'Suravaram',
    'Suwannaphum' => 'Suwannaphum',
    'Signika' => 'Signika',
    'Signika Negative' => 'Signika Negative',
    'Simonetta' => 'Simonetta',
    'Siemreap' => 'Siemreap',
    'Sirin Stencil' => 'Sirin Stencil',
    'Six Caps' => 'Six Caps',
    'Skranji' => 'Skranji',
    'Slackey' => 'Slackey',
    'Smokum' => 'Smokum',
    'Smythe' => 'Smythe',
    'Sniglet' => 'Sniglet',
    'Snippet' => 'Snippet',
    'Snowburst One' => 'Snowburst One',
    'Sofadi One' => 'Sofadi One',
    'Sofia' => 'Sofia',
    'Sonsie One' => 'Sonsie One',
    'Sorts Mill Goudy' => 'Sorts Mill Goudy',
    'Sorts Mill Goudy' => 'Sorts Mill Goudy',
    'Source Code Pro' => 'Source Code Pro',
    'Source Sans Pro' => 'Source Sans Pro',
    'Special I am one' => 'Special I am one',
    'Spicy Rice' => 'Spicy Rice',
    'Spinnaker' => 'Spinnaker',
    'Spirax' => 'Spirax',
    'Squada One' => 'Squada One',
    'Sree Krushnadevaraya' => 'Sree Krushnadevaraya',
    'Stalemate' => 'Stalemate',
    'Stalinist One' => 'Stalinist One',
    'Stardos Stencil' => 'Stardos Stencil',
    'Stint Ultra Condensed' => 'Stint Ultra Condensed',
    'Stint Ultra Expanded' => 'Stint Ultra Expanded',
    'Stoke' => 'Stoke',
    'Stoke' => 'Stoke',
    'Strait' => 'Strait',
    'Sura' => 'Sura',
    'Sumana' => 'Sumana',
    'Sue Ellen Francisco' => 'Sue Ellen Francisco',
    'Sunshiney' => 'Sunshiney',
    'Supermercado One' => 'Supermercado One',
    'Swanky and Moo Moo' => 'Swanky and Moo Moo',
    'Syncopate' => 'Syncopate',
    'Symbol' => 'Symbol',
    'Timmana' => 'Timmana',
    'Taprom' => 'Taprom',
    'Tangerine' => 'Tangerine',
    'Tahoma' => 'Tahoma',
    'Teko' => 'Teko',
    'Telex' => 'Telex',
    'Tenali Ramakrishna' => 'Tenali Ramakrishna',
    'Tenor Sans' => 'Tenor Sans',
    'Terminal Dosis' => 'Terminal Dosis',
    'Terminal Dosis Light' => 'Terminal Dosis Light',
    'Text Me One' => 'Text Me One',
    'The Girl Next Door' => 'The Girl Next Door',
    'Tienne' => 'Tienne',
    'Tillana' => 'Tillana',
    'Tinos' => 'Tinos',
    'Titan One' => 'Titan One',
    'Titillium Web' => 'Titillium Web',
    'Trade Winds' => 'Trade Winds',
    'Trebuchet MS' => 'Trebuchet MS',
    'Trocchi' => 'Trocchi',
    'Trochut' => 'Trochut',
    'Trykker' => 'Trykker',
    'Tulpen One' => 'Tulpen One',
    'Ubuntu' => 'Ubuntu',
    'Ubuntu Condensed' => 'Ubuntu Condensed',
    'Ubuntu Mono' => 'Ubuntu Mono',
    'Ultra' => 'Ultra',
    'Uncial Antiqua' => 'Uncial Antiqua',
    'Underdog' => 'Underdog',
    'Unica One' => 'Unica One',
    'UnifrakturCook' => 'UnifrakturCook',
    'UnifrakturMaguntia' => 'UnifrakturMaguntia',
    'Unkempt' => 'Unkempt',
    'Unlock' => 'Unlock',
    'Unna' => 'Unna',
    'VT323' => 'VT323',
    'Vampiro One' => 'Vampiro One',
    'Varela' => 'Varela',
    'Varela Round' => 'Varela Round',
    'Vast Shadow' => 'Vast Shadow',
    'Vesper Libre' => 'Vesper Libre',
    'Verdana' => 'Verdana',
    'Vibur' => 'Vibur',
    'Vidaloka' => 'Vidaloka',
    'Viga' => 'Viga',
    'Voces' => 'Voces',
    'Volkhov' => 'Volkhov',
    'Vollkorn' => 'Vollkorn',
    'Voltaire' => 'Voltaire',
    'Waiting for the Sunrise' => 'Waiting for the Sunrise',
    'Wallpoet' => 'Wallpoet',
    'Walter Turncoat' => 'Walter Turncoat',
    'Warnes' => 'Warnes',
    'Wellfleet' => 'Wellfleet',
    'Wendy One' => 'Wendy One',
    'Wire One' => 'Wire One',
    'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
    'Yantramanav' => 'Yantramanav',
    'Yellowtail' => 'Yellowtail',
    'Yeseva One' => 'Yeseva One',
    'Yesteryear' => 'Yesteryear',
    'Zeyada' => 'Zeyada'
  );

	//array of all font sizes.
	$font_sizes = array( 
		'10px' => '10px',
		'11px' => '11px',
	);
	
	$options = array();
	$imagepath =  get_template_directory_uri() . '/images/';

	
	for($n=12;$n<=200;$n+=1){
		$font_sizes[$n.'px'] = $n.'px';
	}
	
	// Pull all the pages into an array
	 $options_pages = array();
	 $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	 $options_pages[''] = 'Select a page:';
	 foreach ($options_pages_obj as $page) {
	  $options_pages[$page->ID] = $page->post_title;
	 }

	// array of section content.
	$section_text = array(	
			1 => array(
			'section_title'	=> '',
			'menutitle'		=> 'section1',
			'bgcolor' 		=> '#f6f6f6',
			'bgimage'		=> get_template_directory_uri().'/images/section1.jpg',
			'class'			=> '',
			'content'		=> '[wearesuprime image="'.get_template_directory_uri().'/images/welcome.jpg" title="Welcome to Massage Spa" readmoretext="READ MORE" url="#" color="#282828" bgcolor="#ffffff" ]<p>Fusce vehicula elementum justo, a lobortis purus suscipit quis. Vivamus vulputate risus risus. Proin at dui eros. Nulla et vulputate turpis. Sed congue, libero quis tincidunt lacinia, ligula erat interdum augue, quis facilisis mi diam ut tellus. Phasellus tincidunt diam libero, vitae imperdiet odio lacinia eu. Curabitur eu mauris eget turpis facilisis mattis. </p><p>Nullam ultricies nibh tellus rutrum ultrices eros euismod Scongue, libero quis tincidunt lacinia, ligula erat interdum augue, quis facilisis mi diam ut tellus. Phasellus tincidunt diam libero, vitae imperdiet odio lacinia eu.</p>[/wearesuprime]',
		),		
		
		
		2 => array(
			'section_title'	=> 'OUR VARIETY OF SPA',
			'menutitle'		=> 'section2',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> '',
			'class'			=> '',
			'content'		=> '[tabs]
[tab title="FACIAL"]
	<img src="'.get_template_directory_uri().'/images/spa-variety1.jpg" />
	<h3>FACIAL</h3>
	<h6>$ 55.00 Per head</h6>
	Fusce vehicula elementum justo, a lobortis purus suscipit quis. Vivamus vulputate risus risus. Proin at dui eros. Nulla et vulputate turpis. Sed congue, libero quis tincidunt lacinia, ligula erat interdum augue.
[/tab]
[tab title="HAIR"]
	<img src="'.get_template_directory_uri().'/images/spa-variety2.jpg" />
	<h3>HAIR</h3>
	<h6>$ 105.00 Per head</h6>
	lobortis purus Fusce vehicula elementum justo, a  suscipit quis. Vivamus vulputate risus risus. Proin at dui eros. Nulla et vulputate turpis. Sed congue, libero quis tincidunt lacinia, ligula erat interdum augue.
[/tab]
[tab title="MAKEUP"]
	<img src="'.get_template_directory_uri().'/images/spa-variety3.jpg" />
	<h3>MAKEUP</h3>
	<h6>$ 25.00 Per Person</h6>
	Vivamus vulputate Fusce vehicula elementum justo, a lobortis purus suscipit quis. Vivamus vulputate risus risus. Proin at dui eros. Nulla et vulputate turpis. Sed congue, libero quis tincidunt lacinia, ligula erat interdum augue.
[/tab]
[tab title="MASSAGE"]
	<img src="'.get_template_directory_uri().'/images/spa-variety4.jpg" />
	<h3>MASSAGE</h3>
	<h6>$ 45.00 Per Person</h6>
	Fusce vehicula elementum justo, a lobortis purus suscipit quis. Vivamus vulputate risus risus. Proin at dui eros. Nulla et vulputate turpis. Sed congue, libero quis tincidunt lacinia, ligula erat interdum augue.
[/tab]
[tab title="NAIL"]
	<img src="'.get_template_directory_uri().'/images/spa-variety5.jpg" />
	<h3>NAIL</h3>
	<h6>$ 65.00 Per head</h6>
	Nulla et vulputate Fusce vehicula elementum justo, a lobortis purus suscipit quis. Vivamus vulputate risus risus. Proin at dui eros. turpis. Sed congue, libero quis tincidunt lacinia, ligula erat interdum augue.
[/tab]
[tab title="WAXING"]
	<img src="'.get_template_directory_uri().'/images/spa-variety6.jpg" />
	<h3>WAXING</h3>
	<h6>$ 35.00 Per head</h6>
	Vivamus vulputate risus risus Fusce vehicula elementum justo, a lobortis purus suscipit quis. Vivamus vulputate risus risus. Proin at dui eros. Nulla et vulputate turpis. Sed congue, libero quis tincidunt lacinia, ligula erat interdum augue.
[/tab]
[tab title="SAUNA READY"]
	<img src="'.get_template_directory_uri().'/images/spa-variety7.jpg" />
	<h3>SAUNA READY</h3>
	<h6>$ 75.00 Per head</h6>
	lobortis purus suscipit quis Fusce vehicula elementum justo, a  Vivamus vulputate risus risus. Proin at dui eros. Nulla et vulputate turpis. Sed congue, libero quis tincidunt lacinia, ligula erat interdum augue.
[/tab]
[tab title="FOOT MASSAGE"]
	<img src="'.get_template_directory_uri().'/images/spa-variety8.jpg" />
	<h3>FOOT MASSAGE</h3>
	<h6>$ 135.00 Per head</h6>
	Fusce vehicula elementum justo, Nulla et vulputate turpis. Sed congue, a lobortis purus suscipit quis. Vivamus vulputate risus risus. Proin at dui eros.  libero quis tincidunt lacinia, ligula erat interdum augue.
[/tab]
[/tabs]
'
		),
		
		3 => array(
			'section_title'	=> 'OUR SERVICES',
			'menutitle'		=> 'section3',
			'bgcolor' 		=> '',
			'bgimage'		=> get_template_directory_uri().'/images/section1.jpg',
			'class'			=> '',
			'content'		=> '[services image="'.get_template_directory_uri().'/images/services1.jpg" title="Swedish Massage" link="#"][services image="'.get_template_directory_uri().'/images/services2.jpg" title="Foot Massage" link="#"][services image="'.get_template_directory_uri().'/images/services3.jpg" title="Deep Tissue" link="#"][services image="'.get_template_directory_uri().'/images/services4.jpg" title="Stone Therapy" link="#"]'
		),

		
		4 => array(
			'section_title'	=> 'LATEST NEWS',
			'menutitle'		=> 'section4',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> '',
			'class'			=> '',
			'content'		=> '[latest-news showposts="3"]'
		),
			
		5 => array(
			'section_title'	=> '',
			'menutitle'		=> 'section5',
			'bgcolor' 		=> '#f8f8f8',
			'bgimage'		=> get_template_directory_uri().'/images/section5.jpg',
			'class'			=> '',
			'content'		=> '[column_content type="one_half"][features image="'.get_template_directory_uri().'/images/feature1.jpg" title="Sports massage" description="Sed suscipit mauris nmauris vulputa apouere libero congue."][features image="'.get_template_directory_uri().'/images/feature2.jpg" title="hot stone massage" description="Sed suscipit mauris nmauris vulputa apouere libero congue."][features image="'.get_template_directory_uri().'/images/feature3.jpg" title="massage therapy" description="Sed suscipit mauris nmauris vulputa apouere libero congue."][features image="'.get_template_directory_uri().'/images/feature4.jpg" title="physio therapy" description="Sed suscipit mauris nmauris vulputa apouere libero congue."][clear][/column_content]'
		),			
		
		6 => array(
			'section_title'	=> '',
			'menutitle'		=> 'section6',
			'bgcolor' 		=> '#d6d6d6',
		    'bgimage'		=> '',
			'class'			=> '',
			'content'		=> '[column_content type="one_fourth"][subtitle color="#ffffff" size="22px" margin="10px 0 0 0" align="left" description="WE USE PRODUCTS OF THE BEST BRANDS ONLY"][/column_content][client_lists][client image="'.get_template_directory_uri().'/images/client-logo1.jpg" link="#"][client image="'.get_template_directory_uri().'/images/client-logo2.jpg" link="#"][client image="'.get_template_directory_uri().'/images/client-logo3.jpg" link="#"][client image="'.get_template_directory_uri().'/images/client-logo4.jpg" link="#"][/client_lists]'
		),
		
				
		7 => array(
			'section_title'	=> 'OUR SPECIALISTS',
			'menutitle'		=> 'section7',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> '',
			'class'			=> '',
			'content'		=> '[our-team show="4"]',
		),	
		
		8 => array(
			'section_title'	=> '',
			'menutitle'		=> 'section8',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> get_template_directory_uri().'/images/section8.jpg',
			'class'			=> '',
			'content'		=> '

[column_content type="one_half"]
<h2><span>NEXT SKIN TREATMENT</span> Available Now</h2>
[counter iconname="" value="25" title="SPECIALIST"][counter iconname="" value="100" title="TREATMENT"][counter iconname="" value="60" title="PROMOTION"][counter iconname="" value="20" title="COSMETIC"][/column_content]

[column_content type="one_half_last"]<div class="homecontact"><h3>GET IN TOUCH</h3>[contactform to_email="test@example.com" title="Contact Form"]</div>[/column_content]',
		),
		
		9 => array(
			'section_title'	=> 'OUR PRODUCTS',
			'menutitle'		=> 'section9',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> '',
			'class'			=> '',
			'content'		=> '[recent_products per_page="4" columns="4"]'
			),
		
		10 => array(
			'section_title'	=> '',
			'menutitle'		=> 'section10',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> get_template_directory_uri().'/images/section1.jpg',
			'class'			=> '',
			'content'		=> '[column_content type="one_fifth"][subtitle color="#ffffff" size="30px" margin="0" align="center" description="OUR BRAND"][/column_content][client_lists][client image="'.get_template_directory_uri().'/images/client-logo5.jpg" link="#"][client image="'.get_template_directory_uri().'/images/client-logo6.jpg" link="#"][client image="'.get_template_directory_uri().'/images/client-logo7.jpg" link="#"][client image="'.get_template_directory_uri().'/images/client-logo8.jpg" link="#"][client image="'.get_template_directory_uri().'/images/client-logo9.jpg" link="#"][/client_lists]'
),
				
	);

	$options = array();

	//Basic Settings
	$options[] = array(
		'name' => __('Basic Settings', 'massage-spa-pro'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Logo', 'massage-spa-pro'),
		'desc' => __('Upload your main logo here', 'massage-spa-pro'),
		'id' => 'logo',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
		
	$options[] = array(		
		'desc' => __('Change your custom logo height', 'massage-spa-pro'),
		'id' => 'logoheight',
		'std' => '54',
		'type' => 'text');
		
	$options[] = array(	
		'name' => __('Site title & Description', 'massage-spa-pro'),		
		'desc'	=> __('Check To hide site title and description', 'massage-spa-pro'),
		'id'	=> 'hide_titledesc',
		'type'	=> 'checkbox',
		'std'	=> '');		
		
	$options[] = array(	
		'name' => __('Layout Option', 'massage-spa-pro'),		
		'desc'	=> __('Check To View Box Layout ', 'massage-spa-pro'),
		'id'	=> 'boxlayout',
		'type'	=> 'checkbox',
		'std'	=> '');
			
	$options[] = array(
		'name' => __('Sticky Header', 'massage-spa-pro'),
		'desc' => __('UnCheck this to disable sticky header on scroll', 'massage-spa-pro'),
		'id' => 'headstick',
		'std' => 'true',
		'type' => 'checkbox');		
			
	$options[] = array(
		'name' => __('Disable Animation', 'massage-spa-pro'),
		'desc' => __('Check this to disable animation on scroll', 'massage-spa-pro'),
		'id' => 'scrollanimation',
		'std' => '',
		'type' => 'checkbox');		

	$options[] = array(
		'name' => __('Custom CSS', 'massage-spa-pro'),
		'desc' => __('Some Custom Styling for your site. Place any css codes here instead of the style.css file.', 'massage-spa-pro'),
		'id' => 'style2',
		'std' => '',
		'type' => 'textarea');
		
		$options[] = array(
		'name' => __('Header Top Info', 'massage-spa-pro'),
		'desc' => __('Edit header info from here. NOTE: Icon name should be in lowercase without space.(exa.phone) More social icons can be found at: http://fortawesome.github.io/Font-Awesome/icons/', 'massage-spa-pro'),
		'id' => 'headerinfo',
		'std' => '<i class="fas fa-phone"></i> <span class="phno">+11 123 456 7890</span> <i class="fas fa-envelope"></i> dummyemail@yahoo.com ',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Header Top Social Icons', 'massage-spa-pro'),
		'desc' => __('Edit select social icons for header top', 'massage-spa-pro'),
		'id' => 'headersocial',
		'std' => '[social_area] 
[social icon="fab fa-facebook-f" link="#"] 
[social icon="fab fa-twitter" link="#"] 
[social icon="fab fa-google-plus-g" link="#"] 
[social icon="fab fa-linkedin-in" link="#"] 
[social icon="fas fa-rss" link="#"] 
[social icon="fab fa-youtube" link="#"]
[/social_area]',
		'type' => 'textarea');
		
		

	$options[] = array(
		'name' => __('Header Book An Appointment', 'hotel-center-pro'),
		'desc' => __('Edit select book now for header', 'hotel-center-pro'),
		'id' => 'headerbook',
		'std' => '<a href="#" class="booknow">Book An Appointment</a>',
		'type' => 'textarea');

		
	$options[] = array(
		'name' => __('Disable Header top Strip', 'massage-spa-pro'),
		'desc' => __('UnCheck to disable header top strip', 'massage-spa-pro'),
		'id' => 'headtopstrip',
		'std' => 'true',
		'type' => 'checkbox');		
		
		
	// font family start 		
	$options[] = array(
		'name' => __('Font Faces', 'massage-spa-pro'),
		'desc' => __('Select font for the body text', 'massage-spa-pro'),
		'id' => 'bodyfontface',
		'type' => 'select',
		'std' => 'Roboto',
		'options' => $font_types );
		
	$options[] = array(
		'desc' => __('Select font for the textual logo', 'massage-spa-pro'),
		'id' => 'logofontface',
		'type' => 'select',
		'std' => 'Roboto',
		'options' => $font_types );
		
	$options[] = array(
		'desc' => __('Select font for the navigation text', 'massage-spa-pro'),
		'id' => 'navfontface',
		'type' => 'select',
		'std' => 'Roboto Condensed',
		'options' => $font_types );
		
	$options[] = array(
		'desc' => __('Select font family for all heading tag.', 'massage-spa-pro'),
		'id' => 'headfontface',
		'type' => 'select',
		'std' => 'Roboto',
		'options' => $font_types );
		
	$options[] = array(
		'desc' => __('Select font for Section title', 'massage-spa-pro'),
		'id' => 'sectiontitlefontface',
		'type' => 'select',
		'std' => 'Roboto Condensed',
		'options' => $font_types );		
			
	$options[] = array(
		'desc' => __('Select font for Slide title', 'massage-spa-pro'),
		'id' => 'slidetitlefontface',
		'type' => 'select',
		'std' => 'Roboto Condensed',
		'options' => $font_types );	
		
	$options[] = array(
		'desc' => __('Select font for Slide Description', 'massage-spa-pro'),
		'id' => 'slidedesfontface',
		'type' => 'select',
		'std' => 'Roboto Condensed',
		'options' => $font_types );	

		
	// font sizes start	
	$options[] = array(
		'name' => __('Font Sizes', 'massage-spa-pro'),
		'desc' => __('Select font size for body text', 'massage-spa-pro'),
		'id' => 'bodyfontsize',
		'type' => 'select',
		'std' => '14px',
		'options' => $font_sizes );
		
	$options[] = array(
		'desc' => __('Select font size for textual logo', 'massage-spa-pro'),
		'id' => 'logofontsize',
		'type' => 'select',
		'std' => '28px',
		'options' => $font_sizes );
		
	$options[] = array(
		'desc' => __('Select font size for navigation', 'massage-spa-pro'),
		'id' => 'navfontsize',
		'type' => 'select',
		'std' => '16px',
		'options' => $font_sizes );	
		
	$options[] = array(
		'desc' => __('Select font size for section title', 'massage-spa-pro'),
		'id' => 'sectitlesize',
		'type' => 'select',
		'std' => '34px',
		'options' => $font_sizes );
		
	$options[] = array(
		'desc' => __('Select font size for footer title', 'massage-spa-pro'),
		'id' => 'ftfontsize',
		'type' => 'select',
		'std' => '25px',
		'options' => $font_sizes );	

	$options[] = array(
		'desc' => __('Select h1 font size', 'massage-spa-pro'),
		'id' => 'h1fontsize',
		'std' => '30px',
		'type' => 'select',
		'options' => $font_sizes);

	$options[] = array(
		'desc' => __('Select h2 font size', 'massage-spa-pro'),
		'id' => 'h2fontsize',
		'std' => '28px',
		'type' => 'select',
		'options' => $font_sizes);

	$options[] = array(
		'desc' => __('Select h3 font size', 'massage-spa-pro'),
		'id' => 'h3fontsize',
		'std' => '18px',
		'type' => 'select',
		'options' => $font_sizes);

	$options[] = array(
		'desc' => __('Select h4 font size', 'massage-spa-pro'),
		'id' => 'h4fontsize',
		'std' => '22px',
		'type' => 'select',
		'options' => $font_sizes);

	$options[] = array(
		'desc' => __('Select h5 font size', 'massage-spa-pro'),
		'id' => 'h5fontsize',
		'std' => '20px',
		'type' => 'select',
		'options' => $font_sizes);

	$options[] = array(
		'desc' => __('Select h6 font size', 'massage-spa-pro'),
		'id' => 'h6fontsize',
		'std' => '16px',
		'type' => 'select',
		'options' => $font_sizes);


	// font colors start

	$options[] = array(
		'name' => __('Site Colors Scheme', 'massage-spa-pro'),
		'desc' => __('Change the color scheme of hole site', 'massage-spa-pro'),
		'id' => 'colorscheme',
		'std' => '#cf3a35',
		'type' => 'color');

		
	$options[] = array(	
		'name' => __('Font Colors', 'massage-spa-pro'),	
		'desc' => __('Select font color for the body text', 'massage-spa-pro'),
		'id' => 'bodyfontcolor',
		'std' => '#6E6D6D',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for textual logo', 'massage-spa-pro'),
		'id' => 'logofontcolor',
		'std' => '#333333',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for header top phone and email strip', 'massage-spa-pro'),
		'id' => 'headertopfontcolor',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for logo tagline', 'massage-spa-pro'),
		'id' => 'logotaglinecolor',
		'std' => '#282828',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select font color for header social icons', 'massage-spa-pro'),
		'id' => 'socialfontcolor',
		'std' => '#ffffff',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for section title', 'massage-spa-pro'),
		'id' => 'sectitlecolor',
		'std' => '#2f2e2e',
		'type' => 'color');	
		
	
	$options[] = array(
		'desc' => __('Select font color for navigation', 'massage-spa-pro'),
		'id' => 'navfontcolor',
		'std' => '#242424',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for homepage top four boxes', 'massage-spa-pro'),
		'id' => 'hometopfourbxcolor',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for homepage top four boxes title', 'massage-spa-pro'),
		'id' => 'hometopfourbxtitlecolor',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for homepage top four boxes read more text', 'massage-spa-pro'),
		'id' => 'topfourbxreadmorecolor',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font hover color for homepage top four boxes read more text', 'massage-spa-pro'),
		'id' => 'hometopfourbxreadmorehv',
		'std' => '#ffffff',
		'type' => 'color');			
		
	$options[] = array(
		'desc' => __('Select font color for widget title', 'massage-spa-pro'),
		'id' => 'wdgttitleccolor',
		'std' => '#111111',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for footer title', 'massage-spa-pro'),
		'id' => 'foottitlecolor',
		'std' => '#ffffff',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for footer', 'massage-spa-pro'),
		'id' => 'footdesccolor',
		'std' => '#6a6a6a',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for footer left text (copyright)', 'massage-spa-pro'),
		'id' => 'copycolor',
		'std' => '#6a6a6a',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for footer right text (design by)', 'massage-spa-pro'),
		'id' => 'designcolor',
		'std' => '#6a6a6a',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select font hover color for links / anchor tags', 'massage-spa-pro'),
		'id' => 'linkhovercolor',
		'std' => '#272727',
		'type' => 'color');			
		
	$options[] = array(
		'desc' => __('Select font color for sidebar li a', 'massage-spa-pro'),
		'id' => 'sidebarfontcolor',
		'std' => '#78797c',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font hover color for footer copyright links', 'massage-spa-pro'),
		'id' => 'copylinkshover',
		'std' => '#ffffff',
		'type' => 'color');	

	$options[] = array(
		'desc' => __('Select h1 font color', 'massage-spa-pro'),
		'id' => 'h1fontcolor',
		'std' => '#272727',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select h2 font color', 'massage-spa-pro'),
		'id' => 'h2fontcolor',
		'std' => '#272727',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select h3 font color', 'massage-spa-pro'),
		'id' => 'h3fontcolor',
		'std' => '#272727',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select h4 font color', 'massage-spa-pro'),
		'id' => 'h4fontcolor',
		'std' => '#272727',
		'type' => 'color');	

	$options[] = array(
		'desc' => __('Select h5 font color', 'massage-spa-pro'),
		'id' => 'h5fontcolor',
		'std' => '#272727',
		'type' => 'color');	

	$options[] = array(
		'desc' => __('Select h6 font color', 'massage-spa-pro'),
		'id' => 'h6fontcolor',
		'std' => '#272727',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for footer social icons', 'massage-spa-pro'),
		'id' => 'footsocialcolor',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for gallery filter ', 'massage-spa-pro'),
		'id' => 'galleryfiltercolor',
		'std' => '#010101',
		'type' => 'color');			
		 
	$options[] = array(
		'desc' => __('Select font color for photogallery title ', 'massage-spa-pro'),
		'id' => 'gallerytitlecolorhv',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for latest post title', 'massage-spa-pro'),
		'id' => 'latestpoststtlcolor',
		'std' => '#4b4a4a',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for client testimonilas title', 'massage-spa-pro'),
		'id' => 'testimonialtitlecolor',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for client testimonilas description', 'massage-spa-pro'),
		'id' => 'testimonialdescriptioncolor',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for sidebar widget box', 'massage-spa-pro'),
		'id' => 'widgetboxfontcolor',
		'std' => '#6e6d6d',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for footer recent posts', 'massage-spa-pro'),
		'id' => 'footerpoststitlecolor',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for toggle menu on responsive', 'massage-spa-pro'),
		'id' => 'togglemenucolor',
		'std' => '#ffffff',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font awesome icon color for our theme features section', 'massage-spa-pro'),
		'id' => 'fontawesomeiconcolor',
		'std' => '#272727',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for team member title', 'massage-spa-pro'),
		'id' => 'teamttlfontcolor',
		'std' => '#ffffff',
		'type' => 'color');	
		 	 
	$options[] = array(
		'desc' => __('Select font color for services hover', 'massage-spa-pro'),
		'id' => 'servicehoverfontcolor',
		'std' => '#ffffff',
		'type' => 'color');			
		

	$options[] = array(
		'desc' => __('Select font color for Counter', 'massage-spa-pro'),
		'id' => 'counterfontcolor',
		'std' => '#ffffff',
		'type' => 'color');	
		
	// Background start			
	$options[] = array(
		'name' => __('Background Colors', 'massage-spa-pro'),	
		'desc' => __('Select background color for Header', 'massage-spa-pro'),
		'id' => 'headerbgcolor',
		'std' => '#ffffff',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select background color for footer', 'massage-spa-pro'),
		'id' => 'footerbgcolor',
		'std' => '#1a1a1a',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select background color for header top strip', 'massage-spa-pro'),
		'id' => 'headertopbgstrip',
		'std' => '#111111',
		'type' => 'color');	

	$options[] = array(
		'desc' => __('Select background color for header navigation sub menu', 'massage-spa-pro'),
		'id' => 'navsubbgcolor',
		'std' => '#ffffff',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select background color for top box 1', 'massage-spa-pro'),
		'id' => 'topboxbgcolor1',
		'std' => '#f28e02',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select background color for top box 2', 'massage-spa-pro'),
		'id' => 'topboxbgcolor2',
		'std' => '#009cff',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select background color for top box 3', 'massage-spa-pro'),
		'id' => 'topboxbgcolor3',
		'std' => '#01c28d',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select background color for top box 4', 'massage-spa-pro'),
		'id' => 'topboxbgcolor4',
		'std' => '#fea390',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select background color for top box 5', 'massage-spa-pro'),
		'id' => 'topboxbgcolor5',
		'std' => '#f28e02',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select background color for top box 6', 'massage-spa-pro'),
		'id' => 'topboxbgcolor6',
		'std' => '#f8f7f7',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select background color for our variety of spa', 'massage-spa-pro'),
		'id' => 'ourvarietybg',
		'std' => '#f8f7f7',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select background color for footer Social icon', 'massage-spa-pro'),
		'id' => 'footsocialbgcolor',
		'std' => '#212121',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select background color for copyright section', 'massage-spa-pro'),
		'id' => 'copybgcolor',
		'std' => '',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select background color for client testimonials pager dots', 'massage-spa-pro'),
		'id' => 'testidotsbgcolor',
		'std' => '#494949',
		'type' => 'color');	
	
	$options[] = array(
		'desc' => __('Select background color for sidebar widget box', 'massage-spa-pro'),
		'id' => 'widgetboxbgcolor',
		'std' => '#F0EFEF',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select background color for page boxes read more button', 'massage-spa-pro'),
		'id' => 'hometopfourbxreadmore',
		'std' => '#404040',
		'type' => 'color');			
		
	$options[] = array(
		'desc' => __('Select background color for Counter Hover', 'massage-spa-pro'),
		'id' => 'counterbghover',
		'std' => '#f9f9f9',
		'type' => 'color');			

	$options[] = array(
		'desc' => __('Select background color for Features section', 'massage-spa-pro'),
		'id' => 'featuressection',
		'std' => '#F8F6F7',
		'type' => 'color');			
		
	// Border colors			
	$options[] = array(	
		'name' => __('Border Colors', 'massage-spa-pro'),		
		'desc' => __('Select border color for sidebar li a', 'massage-spa-pro'),
		'id' => 'sidebarliaborder',
		'std' => '#d0cfcf',
		'type' => 'color');	
		  
	// Default Buttons		
	$options[] = array(
		'name' => __('Button Colors', 'massage-spa-pro'),
		'desc' => __('Select background hover color for default button', 'massage-spa-pro'),
		'id' => 'btnbghvcolor',
		'std' => '#202020',
		'type' => 'color');		

	$options[] = array(
		'desc' => __('Select font color default button', 'massage-spa-pro'),
		'id' => 'btntxtcolor',
		'std' => '#ffffff',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select font hover color for default button', 'massage-spa-pro'),
		'id' => 'btntxthvcolor',
		'std' => '#ffffff',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select background color for shop now button on slider', 'massage-spa-pro'),
		'id' => 'shopbtnbgcolor',
		'std' => '#202020',
		'type' => 'color');	
													

	// Slider Caption colors
	$options[] = array(	
		'name' => __('Slider Caption Colors', 'massage-spa-pro'),				
		'desc' => __('Select font color for slider title', 'massage-spa-pro'),
		'id' => 'slidetitlecolor',
		'std' => '#ffffff',
		'type' => 'color');			
		
	$options[] = array(		
		'desc' => __('Select font color for slider description', 'massage-spa-pro'),
		'id' => 'slidedesccolor',
		'std' => '#ffffff',
		'type' => 'color');	
		
		
	$options[] = array(
		'desc' => __('Select font size for slider title', 'massage-spa-pro'),
		'id' => 'slidetitlefontsize',
		'type' => 'select',
		'std' => '66px',
		'options' => $font_sizes );
		
	$options[] = array(
		'desc' => __('Select font size for slider description', 'massage-spa-pro'),
		'id' => 'slidedescfontsize',
		'type' => 'select',
		'std' => '18px',
		'options' => $font_sizes );
		
	// Slider controls colors		
	$options[] = array(
		'name' => __('Slider controls Colors', 'massage-spa-pro'),
		'desc' => __('Select background color for slider pager', 'massage-spa-pro'),
		'id' => 'sldpagebg',
		'std' => '#ffffff',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select background color for slider navigation arrows', 'massage-spa-pro'),
		'id' => 'sldarrowbg',
		'std' => '#000000',
		'type' => 'color');	
		
	$options[] = array(		
		'desc' => __('Select background opacity color for header slider navigation arrows', 'massage-spa-pro'),
		'id' => 'sldarrowopacity',
		'std' => '0.7',
		'type' => 'select',
		'options'	=> array('1'=>1, '0.9'=>0.9,'0.8'=>0.8,'0.7'=>0.7,'0.6'=>0.6,'0.5'=>0.5,'0.4'=>0.4,'0.3'=>0.3,'0.2'=>0.2,));			
		
	$options[] = array(
		'desc' => __('Select Border color for slider pager', 'massage-spa-pro'),
		'id' => 'sldpagehvbd',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(	
		'name' => __('Excerpt Lenth', 'massage-spa-pro'),		
		'desc' => __('Select excerpt length for latest news boxes section', 'massage-spa-pro'),
		'id' => 'latestnewslength',
		'std' => '15',
		'type' => 'text');	


	$options[] = array(		
		'desc' => __('Select excerpt length for testimonials section', 'massage-spa-pro'),
		'id' => 'testimonialsexcerptlength',
		'std' => '60',
		'type' => 'text');
		
	$options[] = array(		
		'desc' => __('Select excerpt length for blog post', 'massage-spa-pro'),
		'id' => 'blogpostexcerptlength',
		'std' => '60',
		'type' => 'text');
		
	$options[] = array(		
		'desc' => __('Select excerpt length for footer latest posts', 'massage-spa-pro'),
		'id' => 'footerpostslength',
		'std' => '6',
		'type' => 'text');	
		
	$options[] = array(		
		'desc' => __('Select excerpt length for home page team member box', 'massage-spa-pro'),
		'id' => 'teammemberlength',
		'std' => '20',
		'type' => 'text');	
		 
	$options[] = array(		
		'desc' => __('Change read more button text for latest blog post section', 'massage-spa-pro'),
		'id' => 'blogpostreadmoretext',
		'std' => 'Read More',
		'type' => 'text');	
		
	$options[] = array(		
		'desc' => __('Change Show All Button text for photo gallery section', 'massage-spa-pro'),
		'id' => 'galleryshowallbtn',
		'std' => 'Show All',
		'type' => 'text');	
		
	$options[] = array(		
		'desc' => __('Change menu word on responsive view', 'massage-spa-pro'),
		'id' => 'menuwordchange',
		'std' => 'Menu',
		'type' => 'text');
		
	$options[] = array(		
		'desc' => __('Change Categories word on blog area', 'massage-spa-pro'),
		'id' => 'categorywordchange',
		'std' => 'Categories:',
		'type' => 'text');				
		
	$options[] = array(
		'name' => __('Blog Single Layout', 'massage-spa-pro'),
		'desc' => __('Select layout. eg:Boxed, Wide', 'massage-spa-pro'),
		'id' => 'singlelayout',
		'type' => 'select',
		'std' => 'singleright',
		'options' => array('singleright'=>'Blog Single Right Sidebar', 'singleleft'=>'Blog Single Left Sidebar', 'sitefull'=>'Blog Single Full Width', 'nosidebar'=>'Blog Single No Sidebar') );	
		
	$options[] = array(
		'name' => __('Woocommerce Page Layout', 'massage-spa-pro'),
		'desc' => __('Select layout. eg:right-sidebar, left-sidebar, full-width', 'massage-spa-pro'),
		'id' => 'woocommercelayout',
		'type' => 'select',
		'std' => 'woocommercesitefull',
		'options' => array('woocommerceright'=>'Woocommerce Right Sidebar', 'woocommerceleft'=>'Woocommerce Left Sidebar', 'woocommercesitefull'=>'Woocommerce Full Width') );	
		
	$options[] = array(	
		'name' => __('Testimonials Rotating Speed', 'massage-spa-pro'),	
		'desc' => __('manage testimonials rotating speed.', 'massage-spa-pro'),
		'id' => 'testimonialsrotatingspeed',
		'std' => '8000',
		'type' => 'text');	
		
	$options[] = array(		
		'desc' => __('True/False Auto play Testimonials.','massage-spa-pro'),
		'id' => 'testimonialsautoplay',
		'std' => 'true',
		'type' => 'select',
		'options' => array('true'=>'True', 'false'=>'False'));			

	$options[] = array(		
		'desc' => __('Select background opacity color for Testimonials', 'massage-spa-pro'),
		'id' => 'testimonilopacity',
		'std' => '0.8',
		'type' => 'select',
		'options'	=> array('1'=>1, '0.9'=>0.9,'0.8'=>0.8,'0.7'=>0.7,'0.6'=>0.6,'0.5'=>0.5,'0.4'=>0.4,'0.3'=>0.3,'0.2'=>0.2,));			
		


	//Layout Settings
	$options[] = array(
		'name' => __('Sections', 'massage-spa-pro'),
		'type' => 'heading');
		
	$options[] = array(	
		'name' => __('Top Four Box Services Section', 'massage-spa-pro'),
		'desc'	=> __('first Services box for frontpage section','massage-spa-pro'),
		'id' 	=> 'box1',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for first box.', 'massage-spa-pro'),
		'id' => 'boximg1',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
	
	$options[] = array(	
		'desc'	=> __('Second Services box for frontpage section','massage-spa-pro'),
		'id' 	=> 'box2',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for second box.', 'massage-spa-pro'),
		'id' => 'boximg2',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
	
	$options[] = array(	
		'desc'	=> __('Third Services box for frontpage section','massage-spa-pro'),
		'id' 	=> 'box3',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for third box.', 'massage-spa-pro'),
		'id' => 'boximg3',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
	
	$options[] = array(	
		'desc'	=> __('Fourth Services box for frontpage section','massage-spa-pro'),
		'id' 	=> 'box4',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for fourth box.', 'massage-spa-pro'),
		'id' => 'boximg4',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
		
	$options[] = array(	
		'desc'	=> __('Fifth Services box for frontpage section','massage-spa-pro'),
		'id' 	=> 'box5',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for fifth box.', 'massage-spa-pro'),
		'id' => 'boximg5',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
		
	$options[] = array(	
		'desc'	=> __('Six Services box for frontpage section','massage-spa-pro'),
		'id' 	=> 'box6',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for six box.', 'massage-spa-pro'),
		'id' => 'boximg6',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');	
		
	$options[] = array(	
		'desc' => __('Change read more button text for top services four boxes ', 'massage-spa-pro'),
		'id' => 'readmorebutton',
		'std' => '',
		'type' => 'text');	
		
	$options[] = array(		
		'desc' => __('Select excerpt length for services four boxes section', 'massage-spa-pro'),
		'id' => 'pageboxlength',
		'std' => '15',
		'type' => 'text');			
	
	$options[] = array(			
			'desc'	=> __('Check to hide above our services three column section', 'massage-spa-pro'),
			'id'	=> 'hidefourbxsec',
			'type'	=> 'checkbox',
			'std'	=> '');
			
	//Section tab
	$options[] = array(
		'name' => __('Number of Sections', 'massage-spa-pro'),
		'desc' => __('Select number of sections', 'massage-spa-pro'),
		'id' => 'numsection',
		'type' => 'select',
		'std' => '10',
		'options' => array_combine(range(1,30), range(1,30)) );

	$numsecs = of_get_option( 'numsection', 10 );

	for( $n=1; $n<=$numsecs; $n++){
		$options[] = array(
			'desc' => __("<h3>Section ".$n."</h3>", 'massage-spa-pro'),
			'class' => 'toggle_title',
			'type' => 'info');	
	
		$options[] = array(
			'name' => __('Section Title', 'massage-spa-pro'),
			'id' => 'sectiontitle'.$n,
			'std' => ( ( isset($section_text[$n]['section_title']) ) ? $section_text[$n]['section_title'] : '' ),
			'type' => 'text');

		$options[] = array(
			'name' => __('Section ID', 'massage-spa-pro'),
			'desc'	=> __('Enter your section ID here. SECTION ID MUST BE IN SMALL LETTERS ONLY AND DO NOT ADD SPACE OR SYMBOL.', 'massage-spa-pro'),
			'id' => 'menutitle'.$n,
			'std' => ( ( isset($section_text[$n]['menutitle']) ) ? $section_text[$n]['menutitle'] : '' ),
			'type' => 'text');

		$options[] = array(
			'name' => __('Section Background Color', 'massage-spa-pro'),
			'desc' => __('Select background color for section', 'massage-spa-pro'),
			'id' => 'sectionbgcolor'.$n,
			'std' => ( ( isset($section_text[$n]['bgcolor']) ) ? $section_text[$n]['bgcolor'] : '' ),
			'type' => 'color');
			
		$options[] = array(
			'name' => __('Background Image', 'massage-spa-pro'),
			'id' => 'sectionbgimage'.$n,
			'class' => '',
			'std' => ( ( isset($section_text[$n]['bgimage']) ) ? $section_text[$n]['bgimage'] : '' ),
			'type' => 'upload');

		$options[] = array(
			'name' => __('Section CSS Class', 'massage-spa-pro'),
			'desc' => __('Set class for this section.', 'massage-spa-pro'),
			'id' => 'sectionclass'.$n,
			'std' => ( ( isset($section_text[$n]['class']) ) ? $section_text[$n]['class'] : '' ),
			'type' => 'text');
			
		$options[] = array(
			'name'	=> __('Hide Section', 'massage-spa-pro'),
			'desc'	=> __('Check to hide this section', 'massage-spa-pro'),
			'id'	=> 'hidesec'.$n,
			'type'	=> 'checkbox',
			'std'	=> '');

		$options[] = array(
			'name' => __('Section Content', 'massage-spa-pro'),
			'id' => 'sectioncontent'.$n,
			'std' => ( ( isset($section_text[$n]['content']) ) ? $section_text[$n]['content'] : '' ),
			'type' => 'editor');
	}


	//SLIDER SETTINGS
	$options[] = array(
		'name' => __('Homepage Slider', 'massage-spa-pro'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Inner Page Banner', 'massage-spa-pro'),
		'desc' => __('Upload inner page banner for site', 'massage-spa-pro'),
		'id' => 'innerpagebanner',
		'class' => '',
		'std'	=> get_template_directory_uri()."/images/inner-banner.jpg",
		'type' => 'upload');
		
		
	$options[] = array(
		'name' => __('Custom Slider Shortcode Area For Home Page', 'massage-spa-pro'),
		'desc' => __('Enter here your slider shortcode without php tag', 'massage-spa-pro'),
		'id' => 'customslider',
		'std' => '',
		'type' => 'textarea');		
		
	$options[] = array(
		'name' => __('Slider Effects and Timing', 'massage-spa-pro'),
		'desc' => __('Select slider effect.','massage-spa-pro'),
		'id' => 'slideefect',
		'std' => 'random',
		'type' => 'select',
		'options' => array('random'=>'Random', 'fade'=>'Fade', 'fold'=>'Fold', 'sliceDown'=>'Slide Down', 'sliceDownLeft'=>'Slide Down Left', 'sliceUp'=>'Slice Up', 'sliceUpLeft'=>'Slice Up Left', 'sliceUpDown'=>'Slice Up Down', 'sliceUpDownLeft'=>'Slice Up Down Left', 'slideInRight'=>'SlideIn Right', 'slideInLeft'=>'SlideIn Left', 'boxRandom'=>'Box Random', 'boxRain'=>'Box Rain', 'boxRainReverse'=>'Box Rain Reverse', 'boxRainGrow'=>'Box Rain Grow', 'boxRainGrowReverse'=>'Box Rain Grow Reverse' ));
		
	$options[] = array(
		'desc' => __('Animation speed should be multiple of 100.', 'massage-spa-pro'),
		'id' => 'slideanim',
		'std' => 500,
		'type' => 'text');
		
	$options[] = array(
		'desc' => __('Add slide pause time.', 'massage-spa-pro'),
		'id' => 'slidepause',
		'std' => 4000,
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slide Controllers', 'massage-spa-pro'),
		'desc' => __('Hide/Show Direction Naviagtion of slider.','massage-spa-pro'),
		'id' => 'slidenav',
		'std' => 'true',
		'type' => 'select',
		'options' => array('true'=>'Show', 'false'=>'Hide'));
		
	$options[] = array(
		'desc' => __('Hide/Show pager of slider.','massage-spa-pro'),
		'id' => 'slidepage',
		'std' => 'false',
		'type' => 'select',
		'options' => array('true'=>'Show', 'false'=>'Hide'));
		
	$options[] = array(
		'desc' => __('Pause Slide on Hover.','massage-spa-pro'),
		'id' => 'slidepausehover',
		'std' => 'false',
		'type' => 'select',
		'options' => array('true'=>'Yes', 'false'=>'No'));	
		
	$options[] = array(
		'name' => __('Slider Image 1', 'massage-spa-pro'),
		'desc' => __('First Slide', 'massage-spa-pro'),
		'id' => 'slide1',
		'class' => '',
		'std' => get_template_directory_uri()."/images/slides/slider1.jpg",
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 1', 'massage-spa-pro'),
		'id' => 'slidetitle1',
		'std' => 'FEEL MORE BEAUTIFUL',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'massage-spa-pro'),
		'id' => 'slidedesc1',
		'std' => 'Give Yourself a Moment to Relax Your Body',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'massage-spa-pro'),
		'id' => 'slidebutton1',
		'std' => 'READ MORE',
		'type' => 'text');	

	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'massage-spa-pro'),
		'id' => 'slideurl1',
		'std' => '#',
		'type' => 'text');		
		
	
	$options[] = array(
		'name' => __('Slider Image 2', 'massage-spa-pro'),
		'desc' => __('Second Slide', 'massage-spa-pro'),
		'class' => '',
		'id' => 'slide2',
		'std' => get_template_directory_uri()."/images/slides/slider2.jpg",
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 2', 'massage-spa-pro'),
		'id' => 'slidetitle2',
		'std' => 'LUXURY STONE SPA',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'massage-spa-pro'),
		'id' => 'slidedesc2',
		'std' => 'The real place of Mindfullness & Healthy body',
		'type' => 'textarea');	
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'massage-spa-pro'),
		'id' => 'slidebutton2',
		'std' => 'READ MORE',
		'type' => 'text');			
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'massage-spa-pro'),
		'id' => 'slideurl2',
		'std' => '#',
		'type' => 'text');	
	
	$options[] = array(
		'name' => __('Slider Image 3', 'massage-spa-pro'),
		'desc' => __('Third Slide', 'massage-spa-pro'),
		'id' => 'slide3',
		'class' => '',
		'std' => get_template_directory_uri()."/images/slides/slider3.jpg",
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 3', 'massage-spa-pro'),
		'id' => 'slidetitle3',
		'std' => 'BEAUTY & SPA SALON',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'massage-spa-pro'),
		'id' => 'slidedesc3',
		'std' => 'Enjoy some much needed me-time during a three-hour spa session. ',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'massage-spa-pro'),
		'id' => 'slidebutton3',
		'std' => 'READ MORE',
		'type' => 'text');			
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'massage-spa-pro'),
		'id' => 'slideurl3',
		'std' => '#',
		'type' => 'text');	
	
	$options[] = array(
		'name' => __('Slider Image 4', 'massage-spa-pro'),
		'desc' => __('Third Slide', 'massage-spa-pro'),
		'id' => 'slide4',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 4', 'massage-spa-pro'),
		'id' => 'slidetitle4',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'massage-spa-pro'),
		'id' => 'slidedesc4',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'massage-spa-pro'),
		'id' => 'slidebutton4',
		'std' => '',
		'type' => 'text');			
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'massage-spa-pro'),
		'id' => 'slideurl4',
		'std' => '',
		'type' => 'text');				
	
	$options[] = array(
		'name' => __('Slider Image 5', 'massage-spa-pro'),
		'desc' => __('Fifth Slide', 'massage-spa-pro'),
		'id' => 'slide5',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 5', 'massage-spa-pro'),
		'id' => 'slidetitle5',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'massage-spa-pro'),
		'id' => 'slidedesc5',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'massage-spa-pro'),
		'id' => 'slidebutton5',
		'std' => '',
		'type' => 'text');			
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'massage-spa-pro'),
		'id' => 'slideurl5',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slider Image 6', 'massage-spa-pro'),
		'desc' => __('Sixth Slide', 'massage-spa-pro'),
		'id' => 'slide6',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 6', 'massage-spa-pro'),
		'id' => 'slidetitle6',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'massage-spa-pro'),
		'id' => 'slidedesc6',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'massage-spa-pro'),
		'id' => 'slidebutton6',
		'std' => '',
		'type' => 'text');		
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'massage-spa-pro'),
		'id' => 'slideurl6',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slider Image 7', 'massage-spa-pro'),
		'desc' => __('Seventh Slide', 'massage-spa-pro'),
		'id' => 'slide7',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 7', 'massage-spa-pro'),
		'id' => 'slidetitle7',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'massage-spa-pro'),
		'id' => 'slidedesc7',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'massage-spa-pro'),
		'id' => 'slidebutton7',
		'std' => '',
		'type' => 'text');			
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'massage-spa-pro'),
		'id' => 'slideurl7',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slider Image 8', 'massage-spa-pro'),
		'desc' => __('Eighth Slide', 'massage-spa-pro'),
		'id' => 'slide8',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 8', 'massage-spa-pro'),
		'id' => 'slidetitle8',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'massage-spa-pro'),
		'id' => 'slidedesc8',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'massage-spa-pro'),
		'id' => 'slidebutton8',
		'std' => '',
		'type' => 'text');		
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'massage-spa-pro'),
		'id' => 'slideurl8',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slider Image 9', 'massage-spa-pro'),
		'desc' => __('Ninth Slide', 'massage-spa-pro'),
		'id' => 'slide9',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 9', 'massage-spa-pro'),
		'id' => 'slidetitle9',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'massage-spa-pro'),
		'id' => 'slidedesc9',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'massage-spa-pro'),
		'id' => 'slidebutton9',
		'std' => '',
		'type' => 'text');			
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'massage-spa-pro'),
		'id' => 'slideurl9',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slider Image 10', 'massage-spa-pro'),
		'desc' => __('Tenth Slide', 'massage-spa-pro'),
		'id' => 'slide10',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 10', 'massage-spa-pro'),
		'id' => 'slidetitle10',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'massage-spa-pro'),
		'id' => 'slidedesc10',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'massage-spa-pro'),
		'id' => 'slidebutton10',
		'std' => '',
		'type' => 'text');			
	
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'massage-spa-pro'),
		'id' => 'slideurl10',
		'std' => '',
		'type' => 'text');
	

	//Footer SETTINGS
	$options[] = array(
		'name' => __('Footer', 'massage-spa-pro'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Footer Layout', 'massage-spa-pro'),
		'desc' => __('footer Select layout. eg:Column, 1, 2, 3 and 4', 'massage-spa-pro'),
		'id' => 'footerlayout',
		'type' => 'select',
		'std' => 'fourcolumn',
		'options' => array('onecolumn'=>'Footer 1 column', 'twocolumn'=>'Footer 2 column', 'threecolumn'=>'Footer 3 column', 'fourcolumn'=>'Footer 4 column', ) );			

	$options[] = array(
		'desc' => __('Select background Image for footer', 'buildup-pro'),
		'id' => 'footerbgimage',
		'std' => get_template_directory_uri().'/images/footer-bg.jpg',
		'type' => 'upload');		 

	$options[] = array(
		'name' => __('About Us Title', 'massage-spa-pro'),
		'desc' => __('Footer About Us title.', 'massage-spa-pro'),
		'id' => 'aboutustitle',
		'std' => 'About Us',
		'type' => 'text');			
		
				
			
	$options[] = array(
		'name' => __('About Us Description', 'massage-spa-pro'),
		'desc' => __('abput us text description for footer', 'massage-spa-pro'),
		'id' => 'aboutusdescription',
		'std' => '<p>Etiamex eget lacus malesuada aliquet sit am libero. Ut bibendum accumsan felis, porttitr mauris posuere sit amet. Etiamex eget lacus malesuada aliquet sit a libero. Ut bibendum accumsan felis, non porttitor mauris posuee sit amet. Sed sed quam purus condimentum siamet in libero Etiamex eget lacmalesuada aliquet sit am libero. Ut bibendum accumsan felis, non porttitor mauris posuer amet.</p>',
		'type' => 'textarea');	
	
	$options[] = array(
		'name' => __('Latest Posts Title', 'massage-spa-pro'),
		'desc' => __('Footer latest posts title.', 'massage-spa-pro'),
		'id' => 'letestpoststitle',
		'std' => 'Recent Posts',
		'type' => 'text');			
		
	$options[] = array(
		'name' => __('Navigation Title', 'massage-spa-pro'),
		'desc' => __('Navigation title.', 'massage-spa-pro'),
		'id' => 'footermenutitle',
		'std' => 'Navigation',
		'type' => 'text');			
		
	$options[] = array(
		'name' => __('Footer Contact Info', 'massage-spa-pro'),
		'desc' => __('Add footer contact info title here', 'massage-spa-pro'),
		'id' => 'contacttitle',
		'std' => 'Get in Touch',
		'type' => 'text');	
		
	$options[] = array(	
		'desc' => __('Add company address here.', 'massage-spa-pro'),
		'id' => 'address',
		'std' => 'Fusce nulla tellus, sodales ultricies dictum eget metus. Integer egestas. sodales ultricies dictum eget metus.',
		'type' => 'textarea');
		
	$options[] = array(		
		'desc' => __('Add phone number here.', 'massage-spa-pro'),
		'id' => 'phone',
		'std' => '345-677-554',
		'type' => 'text');
		
	$options[] = array(		
		'desc' => __('Add fax number here.', 'massage-spa-pro'),
		'id' => 'fax',
		'std' => '123+123456',
		'type' => 'text');	
		
	$options[] = array(
		'desc' => __('Add email address here.', 'massage-spa-pro'),
		'id' => 'email',
		'std' => 'Info@sitename.com',
		'type' => 'text');

	$options[] = array(
		'name' => __('Footer Social Icons', 'massage-spa-pro'),
		'desc' => __('social icons for footer', 'massage-spa-pro'),
		'id' => 'footersocialicon',
		'std' => '<h5>Stay In Touch</h5> 
[social_area]
[social icon="fab fa-facebook-f" link="#"]
[social icon="fab fa-twitter" link="#"]
[social icon="fab fa-linkedin-in" link="#"]
[social icon="fab fa-google-plus-g" link="#"]
[social icon="fas fa-rss" link="#"]
[social icon="fab fa-linkedin-in" link="#"]
[social icon="fab fa-youtube" link="#"]
[social icon="fab fa-instagram" link="#"]
[/social_area]',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Sign Up Newsletter Title', 'massage-spa-pro'),
		'desc' => __('Add title for sign up newsletter', 'massage-spa-pro'),
		'id' => 'newslettertitle',
		'std' => 'Sign Up Newsletter',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Footer Copyright', 'massage-spa-pro'),
		'desc' => __('Copyright Text for your site.', 'massage-spa-pro'),
		'id' => 'copytext',
		'std' => ' Copyright &copy; 2018 Massage Spa',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Footer Text Link', 'massage-spa-pro'),
		'id' => 'ftlink',
		'std' => 'Design by <a href="'.esc_url('https://www.gracethemes.com/').'" target="_blank">Grace Themes</a>',
		'type' => 'textarea',);
		
	$options[] = array(
		'desc' => __('Footer Back to Top Button', 'massage-spa-pro'),
		'id' => 'backtotop',
		'std' => '[back-to-top]',
		'type' => 'textarea',);

	//Short codes
	$options[] = array(
		'name' => __('Short Codes', 'massage-spa-pro'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Photo Gallery', 'massage-spa-pro'),
		'desc' => __('[photogallery filter="true" show="8"]', 'massage-spa-pro'),
		'type' => 'info');	
		
	$options[] = array(
		'name' => __('Testimonials Rotator', 'massage-spa-pro'),
		'desc' => __('[testimonials]', 'massage-spa-pro'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('All Testimonials Listing', 'massage-spa-pro'),
		'desc' => __('[testimonials-listing show="10"]', 'massage-spa-pro'),
		'type' => 'info');	
		
	$options[] = array(
		'name' => __('Sidebar Testimonials Rotator', 'massage-spa-pro'),
		'desc' => __('[sidebar-testimonials]', 'massage-spa-pro'),
		'type' => 'info');		

	$options[] = array(
		'name' => __('Services Shortcode', 'massage-spa-pro'),
		'desc' => __('[services image="ADD YOUR IMAGE URL HERE" title="Swedish Massage" link="#"]', 'massage-spa-pro'),
		'type' => 'info');		
			
	$options[] = array(
		'name' => __('Our Varities Shortcode', 'massage-spa-pro'),
		'desc' => __('[ourvariety]', 'massage-spa-pro'),
		'type' => 'info');		
			
		$options[] = array(
		'name' => __('Recent products Shortcode', 'massage-spa-pro'),
		'desc' => __('[recent_products per_page="4" columns="4"]', 'massage-spa-pro'),
		'type' => 'info');		
			
$options[] = array(
		'name' => __('Welcome Shortcode', 'massage-spa-pro'),
		'desc' => __('[wearesuprime image="ADD YOUR IMAGE URL HERE" title="Welcome to Massage Spa" readmoretext="READ MORE" url="#" color="#6d6d6d" bgcolor="#ffffff" ]<p>Fusce vehicula elementum justo, a lobortis purus suscipit quis. Vivamus vulputate risus risus. Proin at dui eros. Nulla et vulputate turpis. Sed congue, libero quis tincidunt lacinia, ligula erat interdum augue, quis facilisis mi diam ut tellus. Phasellus tincidunt diam libero, vitae imperdiet odio lacinia eu. Curabitur eu mauris eget turpis facilisis mattis. </p><p>Nullam ultricies nibh tellus rutrum ultrices eros euismod Scongue, libero quis tincidunt lacinia, ligula erat interdum augue, quis facilisis mi diam ut tellus. Phasellus tincidunt diam libero, vitae imperdiet odio lacinia eu.</p>[/wearesuprime]', 'massage-spa-pro'),
		'type' => 'info');		
		
	$options[] = array(
		'name' => __('Our Client', 'massage-spa-pro'),
		'desc' => __('[client_lists]<br />
		[client title="Enter here title" image="Enter here client image logo url with https:" link="#"]<br />
		[client title="Enter here title" image="Enter here client image logo url with https:" link="#"]<br />
		[client title="Enter here title" image="Enter here client image logo url with https:" link="#"]<br />
		[client title="Enter here title" image="Enter here client image logo url with https:" link="#"]<br />
		[client title="Enter here title" image="Enter here client image logo url with https:" link="#"]<br />
		[/client_lists]', 'massage-spa-pro'),
		'type' => 'info');	
		
	$options[] = array(
		'name' => __('Contact Form', 'massage-spa-pro'),
		'desc' => __('[contactform to_email="test@example.com" title="Contact Form"] 
', 'massage-spa-pro'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Our Team', 'massage-spa-pro'),
		'desc' => __('[our-team show="4"]', 'massage-spa-pro'),
		'type' => 'info');	
		
	$options[] = array(
		'name' => __('Latest News', 'massage-spa-pro'),
		'desc' => __('[latest-news showposts="3"]', 'massage-spa-pro'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Our Skills', 'massage-spa-pro'),
		'desc' => __('[skill title="Employment Lawyer" percent="90" bgcolor="#cf3a35"][skill title="Corporate Lawyer" percent="70" bgcolor="#cf3a35"][skill title="Bankruptcy Lawyer" percent="55" bgcolor="#cf3a35"][skill title="Criminal Lawyer" percent="95" bgcolor="#cf3a35"]', 'massage-spa-pro'),
		'type' => 'info');	
		
	$options[] = array(
		'name' => __('Custom Button', 'massage-spa-pro'),
		'desc' => __('[button align="center" name="View Gallery" link="#" target=""]', 'massage-spa-pro'),
		'type' => 'info');		
		
	$options[] = array(
		'name' => __('Search Form', 'massage-spa-pro'),
		'desc' => __('[searchform]', 'massage-spa-pro'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Social Icons ( Note: More social icons can be found at: http://fortawesome.github.io/Font-Awesome/icons/)', 'massage-spa-pro'),
		'desc' => __('[social_area]<br />
			[social icon="facebook" link="#"]<br />
			[social icon="twitter" link="#"]<br />
			[social icon="linkedin" link="#"]<br />
			[social icon="google-plus" link="#"]<br />
		[/social_area]', 'massage-spa-pro'),
		'type' => 'info');	

	$options[] = array(
		'name' => __('2 Column Content', 'massage-spa-pro'),
		'desc' => __('<pre>
[column_content type="one_half"]
	Column 1 Content goes here...
[/column_content]

[column_content type="one_half_last"]
	Column 2 Content goes here...
[/column_content]
</pre>', 'massage-spa-pro'),
		'type' => 'info');	

	$options[] = array(
		'name' => __('3 Column Content', 'massage-spa-pro'),
		'desc' => __('<pre>
[column_content type="one_third"]
	Column 1 Content goes here...
[/column_content]

[column_content type="one_third"]
	Column 2 Content goes here...
[/column_content]

[column_content type="one_third_last"]
	Column 3 Content goes here...
[/column_content]
</pre>', 'massage-spa-pro'),
		'type' => 'info');	

	$options[] = array(
		'name' => __('4 Column Content', 'massage-spa-pro'),
		'desc' => __('<pre>
[column_content type="one_fourth"]
	Column 1 Content goes here...
[/column_content]

[column_content type="one_fourth"]
	Column 2 Content goes here...
[/column_content]

[column_content type="one_fourth"]
	Column 3 Content goes here...
[/column_content]

[column_content type="one_fourth_last"]
	Column 4 Content goes here...
[/column_content]
</pre>', 'massage-spa-pro'),
		'type' => 'info');	

	$options[] = array(
		'name' => __('5 Column Content', 'massage-spa-pro'),
		'desc' => __('<pre>
[column_content type="one_fifth"]
	Column 1 Content goes here...
[/column_content]

[column_content type="one_fifth"]
	Column 2 Content goes here...
[/column_content]

[column_content type="one_fifth"]
	Column 3 Content goes here...
[/column_content]

[column_content type="one_fifth"]
	Column 4 Content goes here...
[/column_content]

[column_content type="one_fifth_last"]
	Column 5 Content goes here...
[/column_content]
</pre>', 'massage-spa-pro'),
		'type' => 'info');	

	$options[] = array(
		'name' => __('Tabs', 'massage-spa-pro'),
		'desc' => __('<pre>
[tabs]
	[tab title="TAB TITLE 1"]
		TAB CONTENT 1
	[/tab]
	[tab title="TAB TITLE 2"]
		TAB CONTENT 2
	[/tab]
	[tab title="TAB TITLE 3"]
		TAB CONTENT 3
	[/tab]
[/tabs]
</pre>', 'massage-spa-pro'),
		'type' => 'info');


	$options[] = array(
		'name' => __('Toggle Content', 'massage-spa-pro'),
		'desc' => __('<pre>
[toggle_content title="Toggle Title 1"]
	Toggle content 1...
[/toggle_content]
[toggle_content title="Toggle Title 2"]
	Toggle content 2...
[/toggle_content]
[toggle_content title="Toggle Title 3"]
	Toggle content 3...
[/toggle_content]
</pre>', 'massage-spa-pro'),
		'type' => 'info');


	$options[] = array(
		'name' => __('Accordion Content', 'massage-spa-pro'),
		'desc' => __('<pre>
[accordion]
	[accordion_content title="ACCORDION TITLE 1"]
		ACCORDION CONTENT 1
	[/accordion_content]
	[accordion_content title="ACCORDION TITLE 2"]
		ACCORDION CONTENT 2
	[/accordion_content]
	[accordion_content title="ACCORDION TITLE 3"]
		ACCORDION CONTENT 3
	[/accordion_content]
[/accordion]
</pre>', 'massage-spa-pro'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Clear', 'massage-spa-pro'),
		'desc' => __('<pre>
[clear]
</pre>', 'massage-spa-pro'),
		'type' => 'info');	

	$options[] = array(
		'name' => __('HR / Horizontal separation line', 'massage-spa-pro'),
		'desc' => __('<pre>
[hr] or &lt;hr&gt;
</pre>', 'massage-spa-pro'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Subtitle', 'massage-spa-pro'),
		'desc' => __('[subtitle color="#111111" size="15px" margin="0 0 50px 0" align="" description="short descriptio here"]', 'massage-spa-pro'),
		'type' => 'info');	
	
	$options[] = array(
		'name' => __('Scroll to Top', 'massage-spa-pro'),
		'desc' => __('[back-to-top] 
', 'massage-spa-pro'),
		'type' => 'info');

	return $options;
}