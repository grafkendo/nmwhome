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
 * If you are making your theme translatable, you should replace 'yoga-club'
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
	'Assistant' => 'Assistant',
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
			'section_title'	=> 'Our Classes',
			'menutitle'		=> 'section1',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> '',
			'class'			=> '',
			'content'		=> '[our-classes show="3" date="show"]',
		),
		
		2 => array(
			'section_title'	=> '',
			'menutitle'		=> 'section2',
			'bgcolor' 		=> '#f56c6d',
			'bgimage'		=> get_template_directory_uri().'/images/counterbg.jpg',
			'class'			=> '',
			'content'		=> '[counter value="10" title="Years of experience"][counter value="980" title="Happy clients"][counter value="35" title="Experienced Trainers"] [counter value="100" title="Monthly classes" class="last"]'
		),
		
		3 => array(
			'section_title'	=> '',
			'menutitle'		=> 'section3',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> '',
			'class'			=> '',
			'content'		=> '[column_content type="one_half"]
<h2 class="section_title">Services and <span>Pricing </span></h2>
Morbi nec arcu in purus laoreet efficitur id egestas purus. Nullam et dui sed tellus ultricies fermentum. Suspendisse faucibus nunc ac viverra.
	<ul class="pricing">
		 <li><span>Standard Pricing Plan</span><div class="price"><cite>$ 49</cite>  Per week</div></li>
		 <li><span>Professional Pricing Plan</span><div class="price"><cite>$ 69</cite>  Per week</div></li>
		 <li><span>Private Pricing Plan</span><div class="price"><cite>$ 99</cite>  Per week</div></li>	 
	</ul>
[button align="left" name="View All Services" link="#" target=""]
[/column_content]

[column_content type="one_half_last"]<iframe width="700" height="670" src="https://www.youtube.com/embed/oX6I6vs1EFs" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>[/column_content]',
		),
		
		4 => array(
			'section_title'	=> '',
			'menutitle'		=> 'section4',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> '',
			'class'			=> '',
			'content'		=> '[yoga_center bgcolor="#815c9e" fontcolor="#ffffff" title="Maditation Center" description="Aenean tincidunt elementum porttitor dictum. Pellentes lacus tortor. Vivamus eu ullamcorper nunc." icon="fas fa-tachometer-alt" image="'.get_template_directory_uri().'/images/yogaimg01.jpg" link="#"][yoga_center bgcolor="#f56c6d" fontcolor="#ffffff" title="Maditation Center" description="Aenean tincidunt elementum porttitor dictum. Pellentes lacus tortor. Vivamus eu ullamcorper nunc." icon="fas fa-rocket" image="'.get_template_directory_uri().'/images/yogaimg02.jpg" link="#"]'
		),
		
		5 => array(
			'section_title'	=> 'Latest News',
			'menutitle'		=> 'section5',
			'bgcolor' 		=> '#f1f1f1',
			'bgimage'		=> '',
			'class'			=> 'destination',
			'content'		=> '[latest-news showposts="3" comment="show" date="show" author="show"]'
		),
		
		6 => array(
			'section_title'	=> 'Awesome Events',
			'menutitle'		=> 'section6',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> get_template_directory_uri().'/images/eventbg.jpg',
			'class'			=> '',
			'content'		=> '[our-events show="2"]'
		),	
		
		
		7 => array(
			'section_title'	=> '',
			'menutitle'		=> 'section7',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> get_template_directory_uri().'/images/testimonialbg.jpg',
			'class'			=> 'tmnlwraparea',
			'content'		=> '[testimonials]'
		),				
		
		8 => array(
			'section_title'	=> 'Best Trainer',
			'menutitle'		=> 'section8',
			'bgcolor' 		=> '#f1f1f1',
			'bgimage'		=> '',
			'class'			=> '',
			'content'		=> '[our-team show="4"]',
		),	
		
		9 => array(
			'section_title'	=> 'Our Store',
			'menutitle'		=> 'section9',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> '',
			'class'			=> '',
			'content'		=> '[recent_products per_page="4" columns="4" orderby="date" order="desc"][button align="center" name="View All Products" link="#" target=""] ',
		),
		
		10 => array(
			'section_title'	=> 'Yoga Pricing Plan',
			'menutitle'		=> 'section10',
			'bgcolor' 		=> '#f1f1f1',
			'bgimage'		=>  '',
			'class'			=> '',
			'content'		=> '[pricing_table columns="3"]
[price_column highlight="no" bgcolor="#815c9e"]
	[price_faicon icon="fas fa-rocket"][/price_faicon]
	[price_header bgcolors="#8966a5"]Regular Member[/price_header]
	[price_row]Access club facilities[/price_row]
	[price_row]Outdoor activities[/price_row]
	[price_row]15% off all massage treatments[/price_row]		
	[package_price]$49 <span>Per Month</span>[/package_price]
	[price_footer link="#1"]Get Started[/price_footer]
[/price_column]
[price_column highlight="yes" bgcolor="#f56c6d"]
	[price_faicon icon="fab fa-accusoft"][/price_faicon]
	[price_header bgcolors="#fc7d7d"]V.i.p Member[/price_header]
	[price_row]Free T-shirt & Swags[/price_row]
	[price_row]Access club facilities[/price_row]
	[price_row]Outdoor activities[/price_row]
	[price_row]Free of all massage treatments[/price_row]			
	[package_price]$99 <span>Per Month</span>[/package_price]
	[price_footer link="#2"]Get Started[/price_footer]
[/price_column]
[price_column highlight="no" bgcolor="#815c9e"]
	[price_faicon icon="fas fa-crosshairs"][/price_faicon]
	[price_header bgcolors="#8966a5"]Premium Member[/price_header]
	[price_row]Access club facilities[/price_row]
	[price_row]Outdoor activities[/price_row]
	[price_row]15% off all massage treatments[/price_row]		
	[package_price]$69 <span>Per Month</span>[/package_price]
	[price_footer link="#3"]Get Started[/price_footer]
[/price_column]
[/pricing_table]',
		),
					
	);

	$options = array();

	//Basic Settings
	$options[] = array(
		'name' => __('Basic Settings', 'yoga-club'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Logo', 'yoga-club'),
		'desc' => __('Upload your main logo here', 'yoga-club'),
		'id' => 'logo',
		'class' => '',
		'std'	=> get_template_directory_uri().'/images/logo.png',
		'type' => 'upload');
		
	$options[] = array(		
		'desc' => __('Change your custom logo height', 'yoga-club'),
		'id' => 'logoheight',
		'std' => '49',
		'type' => 'text');
		
	$options[] = array(	
		'name' => __('Site title & Description', 'yoga-club'),		
		'desc'	=> __('uncheck To show site title and description', 'yoga-club'),
		'id'	=> 'hide_titledesc',
		'type'	=> 'checkbox',
		'std'	=> 'true');		
		
	$options[] = array(	
		'name' => __('Layout Option', 'yoga-club'),		
		'desc'	=> __('Check To View Box Layout ', 'yoga-club'),
		'id'	=> 'boxlayout',
		'type'	=> 'checkbox',
		'std'	=> '');
			
	$options[] = array(
		'name' => __('Sticky Header', 'yoga-club'),
		'desc' => __('Check this to disable sticky header on scroll', 'yoga-club'),
		'id' => 'headstick',
		'std' => '',
		'type' => 'checkbox');		
			
	$options[] = array(
		'name' => __('Disable Animation', 'yoga-club'),
		'desc' => __('Check this to disable animation on scroll', 'yoga-club'),
		'id' => 'scrollanimation',
		'std' => '',
		'type' => 'checkbox');		

	$options[] = array(
		'name' => __('Custom CSS', 'yoga-club'),
		'desc' => __('Some Custom Styling for your site. Place any css codes here instead of the style.css file.', 'yoga-club'),
		'id' => 'style2',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Header Top Social Icons', 'yoga-club'),
		'desc' => __('Edit select social icons for header top', 'yoga-club'),
		'id' => 'headersocial',
		'std' => ' [social_area] [social icon="fab fa-facebook-f" link="#"] [social icon="fab fa-twitter" link="#"] [social icon="fab fa-google-plus-g" link="#"] [social icon="fab fa-linkedin-in" link="#"] [social icon="fas fa-rss" link="#"] [social icon="fab fa-youtube" link="#"][/social_area]',
		'type' => 'textarea');	
		
	$options[] = array(
		'name' => __('Header Top Info', 'yoga-club'),
		'desc' => __('Edit header info from here. NOTE: Icon name should be in lowercase without space.(exa.phone) More social icons can be found at: http://fortawesome.github.io/Font-Awesome/icons/', 'yoga-club'),
		'id' => 'headerinfo',
		'std' => '<i class="fa fa-phone-volume"></i> +11 123 456 7890 <span class="phno"><a href="mailto:info@sitename.com"><i class="fa fa-envelope"></i>info@sitename.com</a></span><span class="phno"><i class="fa fa-map-marker"></i>105 West Street Road, Ohio, USA</span>',
		'type' => 'textarea');	
		
	$options[] = array(
		'name' => __('Display Header top Strip', 'yoga-club'),
		'desc' => __('Check to display header top contact info and social icons', 'yoga-club'),
		'id' => 'headtopstrip',
		'std' => '',
		'type' => 'checkbox');	
		
	$options[] = array(
		'name' => __('Header Make an Oppointment Button', 'yoga-club'),
		'desc' => __('Manage Make an Oppointment button', 'yoga-club'),
		'id' => 'headerbook',
		'std' => '<a href="#" class="booknow">Make an Oppointment</a>',
		'type' => 'textarea');		
		
	// font family start 		
	$options[] = array(
		'name' => __('Font Faces', 'yoga-club'),
		'desc' => __('Select font for the body text', 'yoga-club'),
		'id' => 'bodyfontface',
		'type' => 'select',
		'std' => 'Assistant',
		'options' => $font_types );
		
	$options[] = array(
		'desc' => __('Select font for the textual logo', 'yoga-club'),
		'id' => 'logofontface',
		'type' => 'select',
		'std' => 'Assistant',
		'options' => $font_types );
		
	$options[] = array(
		'desc' => __('Select font for the navigation text', 'yoga-club'),
		'id' => 'navfontface',
		'type' => 'select',
		'std' => 'Assistant',
		'options' => $font_types );
		
	$options[] = array(
		'desc' => __('Select font family for all heading tag.', 'yoga-club'),
		'id' => 'headfontface',
		'type' => 'select',
		'std' => 'Assistant',
		'options' => $font_types );
		
	$options[] = array(
		'desc' => __('Select font for Section title', 'yoga-club'),
		'id' => 'sectiontitlefontface',
		'type' => 'select',
		'std' => 'Assistant',
		'options' => $font_types );		
			
	$options[] = array(
		'desc' => __('Select font for Slide title', 'yoga-club'),
		'id' => 'slidetitlefontface',
		'type' => 'select',
		'std' => 'Assistant',
		'options' => $font_types );	
		
	$options[] = array(
		'desc' => __('Select font for Slide Description', 'yoga-club'),
		'id' => 'slidedesfontface',
		'type' => 'select',
		'std' => 'Assistant',
		'options' => $font_types );	

		
	// font sizes start	
	$options[] = array(
		'name' => __('Font Sizes', 'yoga-club'),
		'desc' => __('Select font size for body text', 'yoga-club'),
		'id' => 'bodyfontsize',
		'type' => 'select',
		'std' => '15px',
		'options' => $font_sizes );
		
	$options[] = array(
		'desc' => __('Select font size for textual logo', 'yoga-club'),
		'id' => 'logofontsize',
		'type' => 'select',
		'std' => '32px',
		'options' => $font_sizes );
		
	$options[] = array(
		'desc' => __('Select font size for navigation', 'yoga-club'),
		'id' => 'navfontsize',
		'type' => 'select',
		'std' => '15px',
		'options' => $font_sizes );	
		
	$options[] = array(
		'desc' => __('Select font size for section title', 'yoga-club'),
		'id' => 'sectitlesize',
		'type' => 'select',
		'std' => '42px',
		'options' => $font_sizes );
		
	$options[] = array(
		'desc' => __('Select font size for footer title', 'yoga-club'),
		'id' => 'ftfontsize',
		'type' => 'select',
		'std' => '26px',
		'options' => $font_sizes );	

	$options[] = array(
		'desc' => __('Select h1 font size', 'yoga-club'),
		'id' => 'h1fontsize',
		'std' => '30px',
		'type' => 'select',
		'options' => $font_sizes);

	$options[] = array(
		'desc' => __('Select h2 font size', 'yoga-club'),
		'id' => 'h2fontsize',
		'std' => '28px',
		'type' => 'select',
		'options' => $font_sizes);

	$options[] = array(
		'desc' => __('Select h3 font size', 'yoga-club'),
		'id' => 'h3fontsize',
		'std' => '18px',
		'type' => 'select',
		'options' => $font_sizes);

	$options[] = array(
		'desc' => __('Select h4 font size', 'yoga-club'),
		'id' => 'h4fontsize',
		'std' => '22px',
		'type' => 'select',
		'options' => $font_sizes);

	$options[] = array(
		'desc' => __('Select h5 font size', 'yoga-club'),
		'id' => 'h5fontsize',
		'std' => '20px',
		'type' => 'select',
		'options' => $font_sizes);

	$options[] = array(
		'desc' => __('Select h6 font size', 'yoga-club'),
		'id' => 'h6fontsize',
		'std' => '14px',
		'type' => 'select',
		'options' => $font_sizes);


	// font colors start

	$options[] = array(
		'name' => __('Site Colors Scheme', 'yoga-club'),
		'desc' => __('Change the color scheme of hole site', 'yoga-club'),
		'id' => 'colorscheme',
		'std' => '#f56c6d',
		'type' => 'color');
		
	$options[] = array(		
		'desc' => __('Change the second color scheme of site', 'yoga-club'),
		'id' => 'secondcolorscheme',
		'std' => '#815c9e',
		'type' => 'color');	
		
	$options[] = array(	
		'name' => __('Font Colors', 'yoga-club'),	
		'desc' => __('Select font color for the body text', 'yoga-club'),
		'id' => 'bodyfontcolor',
		'std' => '#6E6D6D',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for header top phone and email strip', 'yoga-club'),
		'id' => 'headertopfontcolor',
		'std' => '#a7a7a7',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for logo tagline', 'yoga-club'),
		'id' => 'logotaglinecolor',
		'std' => '#444444',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select font color for header social icons', 'yoga-club'),
		'id' => 'socialfontcolor',
		'std' => '#a7a7a7',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for section title', 'yoga-club'),
		'id' => 'sectitlecolor',
		'std' => '#4b4a4a',
		'type' => 'color');	
		
	
	$options[] = array(
		'desc' => __('Select font color for navigation', 'yoga-club'),
		'id' => 'navfontcolor',
		'std' => '#3f3e3e',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for homepage top four boxes', 'yoga-club'),
		'id' => 'hometopfourbxcolor',
		'std' => '#6e6d6d',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for homepage top four boxes title', 'yoga-club'),
		'id' => 'hometopfourbxtitlecolor',
		'std' => '#404040',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for widget title', 'yoga-club'),
		'id' => 'wdgttitleccolor',
		'std' => '#ffffff',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for footer title', 'yoga-club'),
		'id' => 'foottitlecolor',
		'std' => '#ffffff',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for footer', 'yoga-club'),
		'id' => 'footdesccolor',
		'std' => '#a7a7a7',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for footer left text (copyright)', 'yoga-club'),
		'id' => 'copycolor',
		'std' => '#ffffff',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for footer right text (design by)', 'yoga-club'),
		'id' => 'designcolor',
		'std' => '#ffffff',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select font hover color for links / anchor tags', 'yoga-club'),
		'id' => 'linkhovercolor',
		'std' => '#272727',
		'type' => 'color');			
		
	$options[] = array(
		'desc' => __('Select font color for sidebar li a', 'yoga-club'),
		'id' => 'sidebarfontcolor',
		'std' => '#78797c',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font hover color for footer copyright links', 'yoga-club'),
		'id' => 'copylinkshover',
		'std' => '#ffffff',
		'type' => 'color');	

	$options[] = array(
		'desc' => __('Select h1 font color', 'yoga-club'),
		'id' => 'h1fontcolor',
		'std' => '#272727',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select h2 font color', 'yoga-club'),
		'id' => 'h2fontcolor',
		'std' => '#272727',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select h3 font color', 'yoga-club'),
		'id' => 'h3fontcolor',
		'std' => '#272727',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select h4 font color', 'yoga-club'),
		'id' => 'h4fontcolor',
		'std' => '#272727',
		'type' => 'color');	

	$options[] = array(
		'desc' => __('Select h5 font color', 'yoga-club'),
		'id' => 'h5fontcolor',
		'std' => '#272727',
		'type' => 'color');	

	$options[] = array(
		'desc' => __('Select h6 font color', 'yoga-club'),
		'id' => 'h6fontcolor',
		'std' => '#272727',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for footer social icons', 'yoga-club'),
		'id' => 'footsocialcolor',
		'std' => '#c1c0c0',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for gallery filter ', 'yoga-club'),
		'id' => 'galleryfiltercolor',
		'std' => '#6e6d6d',
		'type' => 'color');			
		
	$options[] = array(
		'desc' => __('Select font hover color for gallery filter ', 'yoga-club'),
		'id' => 'galleryfiltercolorhv',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for photogallery title ', 'yoga-club'),
		'id' => 'gallerytitlecolorhv',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for latest post title', 'yoga-club'),
		'id' => 'latestpoststtlcolor',
		'std' => '#2b2b2b',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for client testimonilas title', 'yoga-club'),
		'id' => 'testimonialtitlecolor',
		'std' => '#333333',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for client testimonilas description', 'yoga-club'),
		'id' => 'testimonialdescriptioncolor',
		'std' => '#585757',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for sidebar widget box', 'yoga-club'),
		'id' => 'widgetboxfontcolor',
		'std' => '#6e6d6d',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for footer recent posts', 'yoga-club'),
		'id' => 'footerpoststitlecolor',
		'std' => '#a7a7a7',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select font color for toggle menu on responsive', 'yoga-club'),
		'id' => 'togglemenucolor',
		'std' => '#ffffff',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for counter value', 'yoga-club'),
		'id' => 'countervaluecolor',
		'std' => '#ffffff',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select font color for counter title', 'yoga-club'),
		'id' => 'countertitlecolor',
		'std' => '#ffffff',
		'type' => 'color');		
		
	// Background start			
	$options[] = array(
		'name' => __('Background Colors', 'yoga-club'),		
		'desc' => __('Select background color for header', 'yoga-club'),
		'id' => 'headerbgcolor',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(		
		'desc' => __('Select background opacity color for header', 'yoga-club'),
		'id' => 'headerbgcoloropacity',
		'std' => '1',
		'type' => 'select',
		'options'	=> array('1'=>1, '0.9'=>0.9,'0.8'=>0.8,'0.7'=>0.7,'0.6'=>0.6,'0.5'=>0.5,'0.4'=>0.4,'0.3'=>0.3,'0.2'=>0.2,));
		
	$options[] = array(		
		'desc' => __('Select background opacity color for trainer circle', 'yoga-club'),
		'id' => 'traineropacity',
		'std' => '0.8',
		'type' => 'select',
		'options'	=> array('1'=>1, '0.9'=>0.9,'0.8'=>0.8,'0.7'=>0.7,'0.6'=>0.6,'0.5'=>0.5,'0.4'=>0.4,'0.3'=>0.3,'0.2'=>0.2,'0.1'=>0.1,'0'=>0,));
			
	$options[] = array(
		'desc' => __('Select background color for header nav dropdown', 'yoga-club'),
		'id' => 'navdpbgcolor',
		'std' => '#3f3e3e',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select background color homepage top four first box', 'yoga-club'),
		'id' => 'fourbxbgcolor1',
		'std' => '#f5f4f4',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select background color homepage top four second box', 'yoga-club'),
		'id' => 'fourbxbgcolor2',
		'std' => '#ffffff',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select background color homepage top four third box', 'yoga-club'),
		'id' => 'fourbxbgcolor3',
		'std' => '#f5f4f4',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select background color homepage top four fourth box', 'yoga-club'),
		'id' => 'fourbxbgcolor4',
		'std' => '#ffffff',
		'type' => 'color');			
		
	$options[] = array(
		'desc' => __('Select background color for footer', 'yoga-club'),
		'id' => 'footerbgcolor',
		'std' => '#333333',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select background color for footer copy right', 'yoga-club'),
		'id' => 'copybgcolor',
		'std' => '#2c2c2c',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select background color for fhotogallery filter', 'yoga-club'),
		'id' => 'galleryfilter',
		'std' => '#f1f1f1',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select background color for client testimonials pager dots', 'yoga-club'),
		'id' => 'testidotsbgcolor',
		'std' => '#555555',
		'type' => 'color');	
	
	$options[] = array(
		'desc' => __('Select background color for sidebar widget box', 'yoga-club'),
		'id' => 'widgetboxbgcolor',
		'std' => '#F0EFEF',
		'type' => 'color');	
		
	$options[] = array(
		'desc' => __('Select background color for latest news box content', 'yoga-club'),
		'id' => 'newsbxcontentbgcolor',
		'std' => '#ffffff',
		'type' => 'color');						

	// Border colors			
	$options[] = array(	
		'name' => __('Border Colors', 'yoga-club'),		
		'desc' => __('Select border color for sidebar li a', 'yoga-club'),
		'id' => 'sidebarliaborder',
		'std' => '#d0cfcf',
		'type' => 'color');	
		
	$options[] = array(			
		'desc' => __('Select border color for top navigation dropdown li', 'yoga-club'),
		'id' => 'navlibdcolor',
		'std' => '#cccccc',
		'type' => 'color');
		
	$options[] = array(			
		'desc' => __('Select border color for gallery filter', 'yoga-club'),
		'id' => 'galleryfilterbdr',
		'std' => '#494949',
		'type' => 'color');	
		

	// Default Buttons		
	$options[] = array(
		'name' => __('Button Colors', 'yoga-club'),
		'desc' => __('Select background hover color for default button', 'yoga-club'),
		'id' => 'btnbghvcolor',
		'std' => '#555555',
		'type' => 'color');		

	$options[] = array(
		'desc' => __('Select font color default button', 'yoga-club'),
		'id' => 'btntxtcolor',
		'std' => '#ffffff',
		'type' => 'color');

	$options[] = array(
		'desc' => __('Select font hover color for default button', 'yoga-club'),
		'id' => 'btntxthvcolor',
		'std' => '#ffffff',
		'type' => 'color');						

	// Slider Caption colors
	$options[] = array(	
		'name' => __('Slider Caption Colors', 'yoga-club'),				
		'desc' => __('Select font color for slider title', 'yoga-club'),
		'id' => 'slidetitlecolor',
		'std' => '#ffffff',
		'type' => 'color');			
		
	$options[] = array(		
		'desc' => __('Select font color for slider description', 'yoga-club'),
		'id' => 'slidedesccolor',
		'std' => '#ffffff',
		'type' => 'color');	
		
		
	$options[] = array(
		'desc' => __('Select font size for slider title', 'yoga-club'),
		'id' => 'slidetitlefontsize',
		'type' => 'select',
		'std' => '52px',
		'options' => $font_sizes );
		
	$options[] = array(
		'desc' => __('Select font size for slider description', 'yoga-club'),
		'id' => 'slidedescfontsize',
		'type' => 'select',
		'std' => '15px',
		'options' => $font_sizes );
		
	// Slider controls colors		
	$options[] = array(
		'name' => __('Slider controls Colors', 'yoga-club'),
		'desc' => __('Select background color for slider pager (dots)', 'yoga-club'),
		'id' => 'sldpagebg',
		'std' => '#ffffff',
		'type' => 'color');
		
	$options[] = array(
		'desc' => __('Select background color for slider caption', 'yoga-club'),
		'id' => 'sldcaptionbg',
		'std' => '#000000',
		'type' => 'color');		
		
	$options[] = array(		
		'desc' => __('Select background opacity color for slider caption', 'yoga-club'),
		'id' => 'sldcaptionopacity',
		'std' => '0.4',
		'type' => 'select',
		'options'	=> array('1'=>1, '0.9'=>0.9,'0.8'=>0.8,'0.7'=>0.7,'0.6'=>0.6,'0.5'=>0.5,'0.4'=>0.4,'0.3'=>0.3,'0.2'=>0.2,'0.1'=>0.1,'0.0'=>0.0,));		
		
	$options[] = array(
		'desc' => __('Select background color for slider navigation arrows', 'yoga-club'),
		'id' => 'sldarrowbg',
		'std' => '#000000',
		'type' => 'color');	
		
	$options[] = array(		
		'desc' => __('Select background opacity color for header slider navigation arrows', 'yoga-club'),
		'id' => 'sldarrowopacity',
		'std' => '0.0',
		'type' => 'select',
		'options'	=> array('1'=>1, '0.9'=>0.9,'0.8'=>0.8,'0.7'=>0.7,'0.6'=>0.6,'0.5'=>0.5,'0.4'=>0.4,'0.3'=>0.3,'0.2'=>0.2,'0.1'=>0.1,'0.0'=>0.0,));			
		
	$options[] = array(
		'desc' => __('Select Border color for slider pager', 'yoga-club'),
		'id' => 'sldpagehvbd',
		'std' => '#ffffff',
		'type' => 'color');	
		
	$options[] = array(	
		'name' => __('Excerpt Lenth', 'yoga-club'),		
		'desc' => __('Select excerpt length for latest news boxes section', 'yoga-club'),
		'id' => 'latestnewslength',
		'std' => '18',
		'type' => 'text');	
		
	$options[] = array(		
		'desc' => __('Select excerpt length for testimonials section', 'yoga-club'),
		'id' => 'testimonialsexcerptlength',
		'std' => '30',
		'type' => 'text');
		
	$options[] = array(		
		'desc' => __('Select excerpt length for blog post', 'yoga-club'),
		'id' => 'blogpostexcerptlength',
		'std' => '60',
		'type' => 'text');
		
	$options[] = array(		
		'desc' => __('Select excerpt length for footer latest posts', 'yoga-club'),
		'id' => 'footerpostslength',
		'std' => '12',
		'type' => 'text');	
		
	$options[] = array(		
		'desc' => __('Change read more button text for latest blog post section', 'yoga-club'),
		'id' => 'blogpostreadmoretext',
		'std' => 'Read more &rarr;',
		'type' => 'text');	
		
	$options[] = array(		
		'desc' => __('Change Show All Button text for photo gallery section', 'yoga-club'),
		'id' => 'galleryshowallbtn',
		'std' => 'Show All',
		'type' => 'text');	
		
	$options[] = array(		
		'desc' => __('Change menu word on responsive view', 'yoga-club'),
		'id' => 'menuwordchange',
		'std' => 'Menu',
		'type' => 'text');			
		
	$options[] = array(
		'name' => __('Blog Single Layout', 'yoga-club'),
		'desc' => __('Select layout. eg:ight-sidebar, left-sidebar, full-width', 'yoga-club'),
		'id' => 'singlelayout',
		'type' => 'select',
		'std' => 'singleright',
		'options' => array('singleright'=>'Blog Single Right Sidebar', 'singleleft'=>'Blog Single Left Sidebar', 'sitefull'=>'Blog Single Full Width', 'nosidebar'=>'Blog Single No Sidebar') );	
		
	$options[] = array(
		'name' => __('Woocommerce Page Layout', 'yoga-club'),
		'desc' => __('Select layout. eg:right-sidebar, left-sidebar, full-width', 'yoga-club'),
		'id' => 'woocommercelayout',
		'type' => 'select',
		'std' => 'woocommercesitefull',
		'options' => array('woocommerceright'=>'Woocommerce Right Sidebar', 'woocommerceleft'=>'Woocommerce Left Sidebar', 'woocommercesitefull'=>'Woocommerce Full Width') );	
		
	$options[] = array(	
		'name' => __('Testimonials Rotating Speed', 'yoga-club'),	
		'desc' => __('manage testimonials rotating speed.', 'yoga-club'),
		'id' => 'testimonialsrotatingspeed',
		'std' => '8000',
		'type' => 'text');	
		
	$options[] = array(		
		'desc' => __('True/False Auto play Testimonials.','yoga-club'),
		'id' => 'testimonialsautoplay',
		'std' => 'true',
		'type' => 'select',
		'options' => array('true'=>'True', 'false'=>'False'));			
		

	//Layout Settings
	$options[] = array(
		'name' => __('Sections', 'yoga-club'),
		'type' => 'heading');
		
	$options[] = array(	
		'name' => __('Four Box Services Section', 'yoga-club'),		
		'desc'	=> __('first Services box for frontpage section','yoga-club'),
		'id' 	=> 'box1',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for first box.', 'yoga-club'),
		'id' => 'boximg1',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
	
	$options[] = array(	
		'desc'	=> __('Second Services box for frontpage section','yoga-club'),
		'id' 	=> 'box2',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for second box.', 'yoga-club'),
		'id' => 'boximg2',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
	
	$options[] = array(	
		'desc'	=> __('Third Services box for frontpage section','yoga-club'),
		'id' 	=> 'box3',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for third box.', 'yoga-club'),
		'id' => 'boximg3',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
	
	$options[] = array(	
		'desc'	=> __('Fourth Services box for frontpage section','yoga-club'),
		'id' 	=> 'box4',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for fourth box.', 'yoga-club'),
		'id' => 'boximg4',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
		
	$options[] = array(	
		'desc'	=> __('Fifth Services box for frontpage section','yoga-club'),
		'id' 	=> 'box5',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for fifth box.', 'yoga-club'),
		'id' => 'boximg5',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
		
	$options[] = array(	
		'desc'	=> __('Six Services box for frontpage section','yoga-club'),
		'id' 	=> 'box6',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for six box.', 'yoga-club'),
		'id' => 'boximg6',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');	
		
	$options[] = array(		
		'desc' => __('Select excerpt length for services four boxes section', 'yoga-club'),
		'id' => 'pageboxlength',
		'std' => '15',
		'type' => 'text');			
	
	$options[] = array(			
			'desc'	=> __('Check to hide above our services four column section', 'yoga-club'),
			'id'	=> 'hidefourbxsec',
			'type'	=> 'checkbox',
			'std'	=> '');
			
	//welcome sectiom start
	$options[] = array(	
		'name' => __('Welcome to Website Section', 'yoga-club'),
		'desc'	=> __('select page for welcome section','yoga-club'),
		'id' 	=> 'welcomebox',
		'type'	=> 'select',
		'options' => $options_pages,
	);
	
	$options[] = array(		
		'desc' => __('upload image for welcome page', 'yoga-club'),
		'id' => 'welcomeimg',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
		
	$options[] = array(	
		'desc' => __('Change read more button text for welcome page', 'yoga-club'),
		'id' => 'welcomereadmorebutton',
		'std' => '',
		'type' => 'text');	
		
	$options[] = array(		
		'desc' => __('Select excerpt length for welcome page section', 'yoga-club'),
		'id' => 'welcomepagelength',
		'std' => '80',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Welcome Three Box', 'yoga-club'),
		'desc' => __('change welcome three box content', 'yoga-club'),
		'id' => 'welcome3box',
		'std' => '[welcome_3_box]
[box title="Balance Body and Mind" bgcolor="#f56c6d" fontcolor="#ffffff" image="'.get_template_directory_uri().'/images/wlicon01.png" link="#"]

[box title="Healthy Daily Life" bgcolor="#815c9e" fontcolor="#ffffff" image="'.get_template_directory_uri().'/images/wlicon02.png" link="#"]

[box title="Yoga Month Challenge" bgcolor="#f56c6d" fontcolor="#ffffff" image="'.get_template_directory_uri().'/images/wlicon03.png" link="#"]
[clear][/welcome_3_box]',
		'type' => 'textarea');		
		
		
	$options[] = array(			
			'desc'	=> __('Check to hide welcome section', 'yoga-club'),
			'id'	=> 'hidewelcomesection',
			'type'	=> 'checkbox',
			'std'	=> '');	//welcome sectiom end		
			
	
	$options[] = array(
		'name' => __('Number of Sections', 'yoga-club'),
		'desc' => __('Select number of sections', 'yoga-club'),
		'id' => 'numsection',
		'type' => 'select',
		'std' => '10',
		'options' => array_combine(range(1,30), range(1,30)) );

	$numsecs = of_get_option( 'numsection', 10 );

	for( $n=1; $n<=$numsecs; $n++){
		$options[] = array(
			'desc' => __("<h3>Section ".$n."</h3>", 'yoga-club'),
			'class' => 'toggle_title',
			'type' => 'info');	
	
		$options[] = array(
			'name' => __('Section Title', 'yoga-club'),
			'id' => 'sectiontitle'.$n,
			'std' => ( ( isset($section_text[$n]['section_title']) ) ? $section_text[$n]['section_title'] : '' ),
			'type' => 'text');

		$options[] = array(
			'name' => __('Section ID', 'yoga-club'),
			'desc'	=> __('Enter your section ID here. SECTION ID MUST BE IN SMALL LETTERS ONLY AND DO NOT ADD SPACE OR SYMBOL.', 'yoga-club'),
			'id' => 'menutitle'.$n,
			'std' => ( ( isset($section_text[$n]['menutitle']) ) ? $section_text[$n]['menutitle'] : '' ),
			'type' => 'text');

		$options[] = array(
			'name' => __('Section Background Color', 'yoga-club'),
			'desc' => __('Select background color for section', 'yoga-club'),
			'id' => 'sectionbgcolor'.$n,
			'std' => ( ( isset($section_text[$n]['bgcolor']) ) ? $section_text[$n]['bgcolor'] : '' ),
			'type' => 'color');
			
		$options[] = array(
			'name' => __('Background Image', 'yoga-club'),
			'id' => 'sectionbgimage'.$n,
			'class' => '',
			'std' => ( ( isset($section_text[$n]['bgimage']) ) ? $section_text[$n]['bgimage'] : '' ),
			'type' => 'upload');

		$options[] = array(
			'name' => __('Section CSS Class', 'yoga-club'),
			'desc' => __('Set class for this section.', 'yoga-club'),
			'id' => 'sectionclass'.$n,
			'std' => ( ( isset($section_text[$n]['class']) ) ? $section_text[$n]['class'] : '' ),
			'type' => 'text');
			
		$options[] = array(
			'name'	=> __('Hide Section', 'yoga-club'),
			'desc'	=> __('Check to hide this section', 'yoga-club'),
			'id'	=> 'hidesec'.$n,
			'type'	=> 'checkbox',
			'std'	=> '');

		$options[] = array(
			'name' => __('Section Content', 'yoga-club'),
			'id' => 'sectioncontent'.$n,
			'std' => ( ( isset($section_text[$n]['content']) ) ? $section_text[$n]['content'] : '' ),
			'type' => 'editor');
	}


	//SLIDER SETTINGS
	$options[] = array(
		'name' => __('Homepage Slider', 'yoga-club'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Inner Page Banner', 'yoga-club'),
		'desc' => __('Upload inner page banner for site', 'yoga-club'),
		'id' => 'innerpagebanner',
		'class' => '',
		'std'	=> get_template_directory_uri()."/images/inner-banner.jpg",
		'type' => 'upload');
		
		
	$options[] = array(
		'name' => __('Custom Slider Shortcode Area For Home Page', 'yoga-club'),
		'desc' => __('Enter here your slider shortcode without php tag', 'yoga-club'),
		'id' => 'customslider',
		'std' => '',
		'type' => 'textarea');		
		
	$options[] = array(
		'name' => __('Slider Effects and Timing', 'yoga-club'),
		'desc' => __('Select slider effect.','yoga-club'),
		'id' => 'slideefect',
		'std' => 'random',
		'type' => 'select',
		'options' => array('random'=>'Random', 'fade'=>'Fade', 'fold'=>'Fold', 'sliceDown'=>'Slide Down', 'sliceDownLeft'=>'Slide Down Left', 'sliceUp'=>'Slice Up', 'sliceUpLeft'=>'Slice Up Left', 'sliceUpDown'=>'Slice Up Down', 'sliceUpDownLeft'=>'Slice Up Down Left', 'slideInRight'=>'SlideIn Right', 'slideInLeft'=>'SlideIn Left', 'boxRandom'=>'Box Random', 'boxRain'=>'Box Rain', 'boxRainReverse'=>'Box Rain Reverse', 'boxRainGrow'=>'Box Rain Grow', 'boxRainGrowReverse'=>'Box Rain Grow Reverse' ));
		
	$options[] = array(
		'desc' => __('Animation speed should be multiple of 100.', 'yoga-club'),
		'id' => 'slideanim',
		'std' => 500,
		'type' => 'text');
		
	$options[] = array(
		'desc' => __('Add slide pause time.', 'yoga-club'),
		'id' => 'slidepause',
		'std' => 4000,
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slide Controllers', 'yoga-club'),
		'desc' => __('Hide/Show Direction Naviagtion of slider.','yoga-club'),
		'id' => 'slidenav',
		'std' => 'true',
		'type' => 'select',
		'options' => array('true'=>'Show', 'false'=>'Hide'));
		
	$options[] = array(
		'desc' => __('Hide/Show pager of slider.','yoga-club'),
		'id' => 'slidepage',
		'std' => 'true',
		'type' => 'select',
		'options' => array('true'=>'Show', 'false'=>'Hide'));
		
	$options[] = array(
		'desc' => __('Pause Slide on Hover.','yoga-club'),
		'id' => 'slidepausehover',
		'std' => 'false',
		'type' => 'select',
		'options' => array('true'=>'Yes', 'false'=>'No'));
		
		
	$options[] = array(
		'name' => __('Slider Image 1', 'yoga-club'),
		'desc' => __('First Slide', 'yoga-club'),
		'id' => 'slide1',
		'class' => '',
		'std' => get_template_directory_uri()."/images/slides/slider1.jpg",
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 1', 'yoga-club'),
		'id' => 'slidetitle1',
		'std' => '<h3><span>Welcome To Yoga</span></h3>
<h2><span>For Perfect of Mind & A Better Body</span></h2>',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'yoga-club'),
		'id' => 'slidedesc1',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'yoga-club'),
		'id' => 'slidebutton1',
		'std' => '',
		'type' => 'text');	

	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'yoga-club'),
		'id' => 'slideurl1',
		'std' => '',
		'type' => 'text');		
		
	
	$options[] = array(
		'name' => __('Slider Image 2', 'yoga-club'),
		'desc' => __('Second Slide', 'yoga-club'),
		'class' => '',
		'id' => 'slide2',
		'std' => get_template_directory_uri()."/images/slides/slider2.jpg",
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 2', 'yoga-club'),
		'id' => 'slidetitle2',
		'std' => '<h3><span>Discover a new way</span></h3>
<h2><span>To Rejuvenate Yourself</span></h2>',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'yoga-club'),
		'id' => 'slidedesc2',
		'std' => '',
		'type' => 'textarea');	
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'yoga-club'),
		'id' => 'slidebutton2',
		'std' => '',
		'type' => 'text');			
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'yoga-club'),
		'id' => 'slideurl2',
		'std' => '',
		'type' => 'text');	
	
	$options[] = array(
		'name' => __('Slider Image 3', 'yoga-club'),
		'desc' => __('Third Slide', 'yoga-club'),
		'id' => 'slide3',
		'class' => '',
		'std' => get_template_directory_uri()."/images/slides/slider3.jpg",
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 3', 'yoga-club'),
		'id' => 'slidetitle3',
		'std' => '<h3><span>Meditation</span></h3>
<h2><span>Inspiration for Joyful Living</span></h2>',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'yoga-club'),
		'id' => 'slidedesc3',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'yoga-club'),
		'id' => 'slidebutton3',
		'std' => '',
		'type' => 'text');			
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'yoga-club'),
		'id' => 'slideurl3',
		'std' => '',
		'type' => 'text');	
	
	$options[] = array(
		'name' => __('Slider Image 4', 'yoga-club'),
		'desc' => __('Third Slide', 'yoga-club'),
		'id' => 'slide4',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 4', 'yoga-club'),
		'id' => 'slidetitle4',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'yoga-club'),
		'id' => 'slidedesc4',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'yoga-club'),
		'id' => 'slidebutton4',
		'std' => '',
		'type' => 'text');			
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'yoga-club'),
		'id' => 'slideurl4',
		'std' => '',
		'type' => 'text');				
	
	$options[] = array(
		'name' => __('Slider Image 5', 'yoga-club'),
		'desc' => __('Fifth Slide', 'yoga-club'),
		'id' => 'slide5',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 5', 'yoga-club'),
		'id' => 'slidetitle5',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'yoga-club'),
		'id' => 'slidedesc5',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'yoga-club'),
		'id' => 'slidebutton5',
		'std' => '',
		'type' => 'text');			
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'yoga-club'),
		'id' => 'slideurl5',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slider Image 6', 'yoga-club'),
		'desc' => __('Sixth Slide', 'yoga-club'),
		'id' => 'slide6',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 6', 'yoga-club'),
		'id' => 'slidetitle6',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'yoga-club'),
		'id' => 'slidedesc6',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'yoga-club'),
		'id' => 'slidebutton6',
		'std' => '',
		'type' => 'text');		
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'yoga-club'),
		'id' => 'slideurl6',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slider Image 7', 'yoga-club'),
		'desc' => __('Seventh Slide', 'yoga-club'),
		'id' => 'slide7',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 7', 'yoga-club'),
		'id' => 'slidetitle7',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'yoga-club'),
		'id' => 'slidedesc7',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'yoga-club'),
		'id' => 'slidebutton7',
		'std' => '',
		'type' => 'text');			
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'yoga-club'),
		'id' => 'slideurl7',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slider Image 8', 'yoga-club'),
		'desc' => __('Eighth Slide', 'yoga-club'),
		'id' => 'slide8',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 8', 'yoga-club'),
		'id' => 'slidetitle8',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'yoga-club'),
		'id' => 'slidedesc8',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'yoga-club'),
		'id' => 'slidebutton8',
		'std' => '',
		'type' => 'text');		
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'yoga-club'),
		'id' => 'slideurl8',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slider Image 9', 'yoga-club'),
		'desc' => __('Ninth Slide', 'yoga-club'),
		'id' => 'slide9',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 9', 'yoga-club'),
		'id' => 'slidetitle9',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'yoga-club'),
		'id' => 'slidedesc9',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'yoga-club'),
		'id' => 'slidebutton9',
		'std' => '',
		'type' => 'text');			
		
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'yoga-club'),
		'id' => 'slideurl9',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slider Image 10', 'yoga-club'),
		'desc' => __('Tenth Slide', 'yoga-club'),
		'id' => 'slide10',
		'class' => '',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'desc' => __('Title 10', 'yoga-club'),
		'id' => 'slidetitle10',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'yoga-club'),
		'id' => 'slidedesc10',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Read More Button Text', 'yoga-club'),
		'id' => 'slidebutton10',
		'std' => '',
		'type' => 'text');			
	
	$options[] = array(
		'desc' => __('Slide Url for Read More Button', 'yoga-club'),
		'id' => 'slideurl10',
		'std' => '',
		'type' => 'text');
	

	//Footer SETTINGS
	$options[] = array(
		'name' => __('Footer', 'yoga-club'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Footer Layout', 'yoga-club'),
		'desc' => __('footer Select layout. eg:Boxed, 1, 2, 3 and 4', 'yoga-club'),
		'id' => 'footerlayout',
		'type' => 'select',
		'std' => 'fourcolumn',
		'options' => array('onecolumn'=>'Footer 1 column', 'twocolumn'=>'Footer 2 column', 'threecolumn'=>'Footer 3 column', 'fourcolumn'=>'Footer 4 column', ) );			
				
	$options[] = array(
		'name' => __('Footer Yoga Club Title', 'yoga-club'),
		'desc' => __('yoga club title for footer', 'yoga-club'),
		'id' => 'abouttitle',
		'std' => 'Yoga Club',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Yoga Club Description', 'yoga-club'),
		'desc' => __('Yoga Club description for footer', 'yoga-club'),
		'id' => 'aboutusdescription',
		'std' => '<p>Aenean tincidunt elementum porttitor dictum. Pellentes lacus tortor. Vivamus eu ullamcorper nunc.</p>',
		'type' => 'textarea');	
	
	$options[] = array(
		'name' => __('Recent News Title', 'yoga-club'),
		'desc' => __('Footer recent news title.', 'yoga-club'),
		'id' => 'letestpoststitle',
		'std' => 'Recent News',
		'type' => 'text');			
		
	$options[] = array(
		'name' => __('Footer Quick links Title', 'yoga-club'),
		'desc' => __('footer quick links title.', 'yoga-club'),
		'id' => 'footermenutitle',
		'std' => 'Quick Links',
		'type' => 'text');			
		
	$options[] = array(
		'name' => __('Footer Contact Info', 'yoga-club'),
		'desc' => __('Add footer contact info title here', 'yoga-club'),
		'id' => 'contacttitle',
		'std' => 'Contact Info',
		'type' => 'text');	
		
	$options[] = array(	
		'desc' => __('Add company address here.', 'yoga-club'),
		'id' => 'address',
		'std' => '109 East Street Road, Ohio, USA',
		'type' => 'textarea');
		
	$options[] = array(		
		'desc' => __('Add phone number here.', 'yoga-club'),
		'id' => 'phone',
		'std' => '+91 987 654 3210',
		'type' => 'text');
		
	$options[] = array(		
		'desc' => __('Add fax number here.', 'yoga-club'),
		'id' => 'fax',
		'std' => '',
		'type' => 'text');	
		
	$options[] = array(
		'desc' => __('Add email address here.', 'yoga-club'),
		'id' => 'email',
		'std' => 'info@sitename.com',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Footer Social Icons', 'yoga-club'),
		'desc' => __('social icons for footer', 'yoga-club'),
		'id' => 'footersocialicon',
		'std' => '[social_area]
			[social icon="fab fa-facebook-f" link="#"]
			[social icon="fab fa-twitter" link="#"]
			[social icon="fab fa-linkedin-in" link="#"]
			[social icon="fab fa-google-plus-g" link="#"]				
		[/social_area]
		',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Footer Copyright', 'yoga-club'),
		'desc' => __('Copyright Text for your site.', 'yoga-club'),
		'id' => 'copytext',
		'std' => ' Copyright &copy; 2018. All rights reserved',
		'type' => 'textarea');
		
	$options[] = array(
		'desc' => __('Footre Text Link', 'yoga-club'),
		'id' => 'ftlink',
		'std' => 'Design by <a href="'.esc_url('https://www.gracethemes.com/').'" target="_blank">Grace Themes</a>',
		'type' => 'textarea',);
		
	$options[] = array(
		'desc' => __('Footer Back to Top Button', 'yoga-club'),
		'id' => 'backtotop',
		'std' => '[back-to-top]',
		'type' => 'textarea',);

	//Short codes
	$options[] = array(
		'name' => __('Short Codes', 'yoga-club'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Welcome Section 3 box', 'yoga-club'),
		'desc' => __('[welcome_3_box]<br />
		[box title="Balance Body and Mind" bgcolor="#f56c6d" fontcolor="#ffffff" image="enter image url with http:" link="#"]<br />
		[box title="Healthy Daily Life" bgcolor="#815c9e" fontcolor="#ffffff" image="enter image url with http:" link="#"]<br />
		[box title="Yoga Month Challenge" bgcolor="#f56c6d" fontcolor="#ffffff" image="enter image url with http:" link="#"]<br />
		[/welcome_3_box]', 'yoga-club'),
		'type' => 'info');	
		
	$options[] = array(
		'name' => __('Our Classes', 'yoga-club'),
		'desc' => __('[our-classes show="3" date="show"]', 'yoga-club'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Our Counter', 'yoga-club'),
		'desc' => __('[counter value="10" title="Years of experience"][counter value="980" title="Happy clients"][counter value="35" title="Experienced Trainers"] [counter value="100" title="Monthly classes" class="last"]', 'yoga-club'),
		'type' => 'info');	
		
	$options[] = array(
		'name' => __('Our Counter', 'yoga-club'),
		'desc' => __('[yoga_center bgcolor="#815c9e" fontcolor="#ffffff" title="Maditation Center" description="Aenean tincidunt elementum porttitor dictum. Pellentes lacus tortor. Vivamus eu ullamcorper nunc." icon="fas fa-tachometer-alt" image="enter image url with http:" link="#"]<br />
		[yoga_center  bgcolor="#f56c6d" fontcolor="#ffffff" title="Maditation Center" description="Aenean tincidunt elementum porttitor dictum. Pellentes lacus tortor. Vivamus eu ullamcorper nunc." icon="fas fa-rocket" image="enter image url with http:" link="#"]', 'yoga-club'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Latest News', 'yoga-club'),
		'desc' => __('[latest-news showposts="4" comment="show" date="show" author="show"]', 'yoga-club'),
		'type' => 'info');		
		
	$options[] = array(
		'name' => __('Our Events', 'yoga-club'),
		'desc' => __('[our-events show="2"]', 'yoga-club'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Testimonials Rotator', 'yoga-club'),
		'desc' => __('[testimonials]', 'yoga-club'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('All Testimonials Listing', 'yoga-club'),
		'desc' => __('[testimonials-listing show="10"]', 'yoga-club'),
		'type' => 'info');	
		
	$options[] = array(
		'name' => __('Sidebar Testimonials Rotator', 'yoga-club'),
		'desc' => __('[sidebar-testimonials]', 'yoga-club'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Our Trainer', 'yoga-club'),
		'desc' => __('[our-team show="4"]', 'yoga-club'),
		'type' => 'info');			
		
	$options[] = array(
		'name' => __('Our Store', 'yoga-club'),
		'desc' => __('[recent_products per_page="4" columns="4" orderby="date" order="desc"]', 'yoga-club'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Our Pricing Table', 'yoga-club'),
		'desc' => __('[pricing_table columns="3"]<br />
	[price_column highlight="no" bgcolor="#815c9e"]<br />
		[price_faicon icon="fas fa-rocket"][/price_faicon]<br />
		[price_header bgcolors="#8966a5"]Regular Member[/price_header]<br />
		[price_row]Access club facilities[/price_row]<br />
		[price_row]Outdoor activities[/price_row]<br />
		[price_row]15% off all massage treatments[/price_row]	<br />	
		[package_price]$49 <span>Per Month</span>[/package_price]<br />
		[price_footer link="#1"]Get Started[/price_footer]<br />
	[/price_column][price_column highlight="yes" bgcolor="#f56c6d"]<br />
		[price_faicon icon="fab fa-accusoft"][/price_faicon]<br />
		[price_header bgcolors="#fc7d7d"]V.i.p Member[/price_header]<br />
		[price_row]Free T-shirt & Swags[/price_row]<br />
		[price_row]Access club facilities[/price_row]<br />
		[price_row]Outdoor activities[/price_row]<br />
		[price_row]Free of all massage treatments[/price_row]	<br />		
		[package_price]$99 <span>Per Month</span>[/package_price]<br />
		[price_footer link="#2"]Get Started[/price_footer]<br />
	[/price_column][price_column highlight="no" bgcolor="#815c9e"]<br />
		[price_faicon icon="fas fa-crosshairs"][/price_faicon]<br />
		[price_header bgcolors="#8966a5"]Premium Member[/price_header]<br />
		[price_row]Access club facilities[/price_row]<br />
		[price_row]Outdoor activities[/price_row]<br />
		[price_row]15% off all massage treatments[/price_row]	<br />	
		[package_price]$69 <span>Per Month</span>[/package_price]<br />
		[price_footer link="#3"]Get Started[/price_footer]<br />
	[/price_column]<br />
[/pricing_table]', 'yoga-club'),
		'type' => 'info');	
		
	$options[] = array(
		'name' => __('Client Rotator', 'yoga-club'),
		'desc' => __('[client_lists]<br />
		[client title="Enter here title" image="Enter here client image logo url with https:" link="#"]<br />
		[client title="Enter here title" image="Enter here client image logo url with https:" link="#"]<br />
		[client title="Enter here title" image="Enter here client image logo url with https:" link="#"]<br />
		[client title="Enter here title" image="Enter here client image logo url with https:" link="#"]<br />
		[client title="Enter here title" image="Enter here client image logo url with https:" link="#"]<br />
		[/client_lists]', 'yoga-club'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Photo Gallery', 'yoga-club'),
		'desc' => __('[photogallery filter="true" show="8"]', 'yoga-club'),
		'type' => 'info');		
		
	$options[] = array(
		'name' => __('Contact Form', 'yoga-club'),
		'desc' => __('[contactform to_email="test@example.com" title="Contact Form"] 
', 'yoga-club'),
		'type' => 'info');

	
	
		
	$options[] = array(
		'name' => __('Our Skills', 'yoga-club'),
		'desc' => __('[skill title="Coding" percent="90" bgcolor="#65676a"][skill title="Design" percent="70" bgcolor="#65676a"][skill title="Building" percent="55" bgcolor="#65676a"][skill title="SEO" percent="100" bgcolor="#65676a"]', 'yoga-club'),
		'type' => 'info');	
		
	$options[] = array(
		'name' => __('Custom Button', 'yoga-club'),
		'desc' => __('[button align="center" name="Read More" link="#" target=""]', 'yoga-club'),
		'type' => 'info');	
		
	$options[] = array(
		'name' => __('Search Form', 'yoga-club'),
		'desc' => __('[searchform]', 'yoga-club'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Social Icons ( Note: More social icons can be found at: http://fortawesome.github.io/Font-Awesome/icons/)', 'yoga-club'),
		'desc' => __('[social_area]<br />
			[social icon="facebook" link="#"]<br />
			[social icon="twitter" link="#"]<br />
			[social icon="linkedin" link="#"]<br />
			[social icon="google-plus" link="#"]<br />
		[/social_area]', 'yoga-club'),
		'type' => 'info');	

	$options[] = array(
		'name' => __('2 Column Content', 'yoga-club'),
		'desc' => __('<pre>
[column_content type="one_half"]
	Column 1 Content goes here...
[/column_content]

[column_content type="one_half_last"]
	Column 2 Content goes here...
[/column_content]
</pre>', 'yoga-club'),
		'type' => 'info');	

	$options[] = array(
		'name' => __('3 Column Content', 'yoga-club'),
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
</pre>', 'yoga-club'),
		'type' => 'info');	

	$options[] = array(
		'name' => __('4 Column Content', 'yoga-club'),
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
</pre>', 'yoga-club'),
		'type' => 'info');	

	$options[] = array(
		'name' => __('5 Column Content', 'yoga-club'),
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
</pre>', 'yoga-club'),
		'type' => 'info');	

	$options[] = array(
		'name' => __('Tabs', 'yoga-club'),
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
</pre>', 'yoga-club'),
		'type' => 'info');


	$options[] = array(
		'name' => __('Toggle Content', 'yoga-club'),
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
</pre>', 'yoga-club'),
		'type' => 'info');


	$options[] = array(
		'name' => __('Accordion Content', 'yoga-club'),
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
</pre>', 'yoga-club'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Clear', 'yoga-club'),
		'desc' => __('<pre>
[clear]
</pre>', 'yoga-club'),
		'type' => 'info');	

	$options[] = array(
		'name' => __('HR / Horizontal separation line', 'yoga-club'),
		'desc' => __('<pre>
[hr] or &lt;hr&gt;
</pre>', 'yoga-club'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Subtitle', 'yoga-club'),
		'desc' => __('[subtitle color="#111111" size="15px" align="left" description="short descriptio here"]', 'yoga-club'),
		'type' => 'info');	
	
	$options[] = array(
		'name' => __('Scroll to Top', 'yoga-club'),
		'desc' => __('[back-to-top] 
', 'yoga-club'),
		'type' => 'info');

	return $options;
}