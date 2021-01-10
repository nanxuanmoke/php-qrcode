<?php
/**
 * Class Version
 *
 * @filesource   Version.php
 * @created      19.11.2020
 * @package      chillerlan\QRCode\Common
 * @author       smiley <smiley@chillerlan.net>
 * @copyright    2020 smiley
 * @license      MIT
 */

namespace chillerlan\QRCode\Common;

use chillerlan\QRCode\QRCodeException;

/**
 *
 */
final class Version{

	/**
	 * ISO/IEC 18004:2000 Annex E, Table E.1 - Row/column coordinates of center module of Alignment Patterns
	 *
	 * version -> pattern
	 *
	 * @var int[][]
	 */
	private const ALIGNMENT_PATTERN = [
		1  => [],
		2  => [6, 18],
		3  => [6, 22],
		4  => [6, 26],
		5  => [6, 30],
		6  => [6, 34],
		7  => [6, 22, 38],
		8  => [6, 24, 42],
		9  => [6, 26, 46],
		10 => [6, 28, 50],
		11 => [6, 30, 54],
		12 => [6, 32, 58],
		13 => [6, 34, 62],
		14 => [6, 26, 46, 66],
		15 => [6, 26, 48, 70],
		16 => [6, 26, 50, 74],
		17 => [6, 30, 54, 78],
		18 => [6, 30, 56, 82],
		19 => [6, 30, 58, 86],
		20 => [6, 34, 62, 90],
		21 => [6, 28, 50, 72,  94],
		22 => [6, 26, 50, 74,  98],
		23 => [6, 30, 54, 78, 102],
		24 => [6, 28, 54, 80, 106],
		25 => [6, 32, 58, 84, 110],
		26 => [6, 30, 58, 86, 114],
		27 => [6, 34, 62, 90, 118],
		28 => [6, 26, 50, 74,  98, 122],
		29 => [6, 30, 54, 78, 102, 126],
		30 => [6, 26, 52, 78, 104, 130],
		31 => [6, 30, 56, 82, 108, 134],
		32 => [6, 34, 60, 86, 112, 138],
		33 => [6, 30, 58, 86, 114, 142],
		34 => [6, 34, 62, 90, 118, 146],
		35 => [6, 30, 54, 78, 102, 126, 150],
		36 => [6, 24, 50, 76, 102, 128, 154],
		37 => [6, 28, 54, 80, 106, 132, 158],
		38 => [6, 32, 58, 84, 110, 136, 162],
		39 => [6, 26, 54, 82, 110, 138, 166],
		40 => [6, 30, 58, 86, 114, 142, 170],
	];

	/**
	 * ISO/IEC 18004:2000 Annex D, Table D.1 - Version information bit stream for each version
	 *
	 * no version pattern for QR Codes < 7
	 *
	 * @var int[]
	 */
	private const VERSION_PATTERN = [
		7  => 0b000111110010010100,
		8  => 0b001000010110111100,
		9  => 0b001001101010011001,
		10 => 0b001010010011010011,
		11 => 0b001011101111110110,
		12 => 0b001100011101100010,
		13 => 0b001101100001000111,
		14 => 0b001110011000001101,
		15 => 0b001111100100101000,
		16 => 0b010000101101111000,
		17 => 0b010001010001011101,
		18 => 0b010010101000010111,
		19 => 0b010011010100110010,
		20 => 0b010100100110100110,
		21 => 0b010101011010000011,
		22 => 0b010110100011001001,
		23 => 0b010111011111101100,
		24 => 0b011000111011000100,
		25 => 0b011001000111100001,
		26 => 0b011010111110101011,
		27 => 0b011011000010001110,
		28 => 0b011100110000011010,
		29 => 0b011101001100111111,
		30 => 0b011110110101110101,
		31 => 0b011111001001010000,
		32 => 0b100000100111010101,
		33 => 0b100001011011110000,
		34 => 0b100010100010111010,
		35 => 0b100011011110011111,
		36 => 0b100100101100001011,
		37 => 0b100101010000101110,
		38 => 0b100110101001100100,
		39 => 0b100111010101000001,
		40 => 0b101000110001101001,
	];

	/**
	 * ISO/IEC 18004:2000 Tables 7-11 - Number of symbol characters and input data capacity for versions 1 to 40
	 *
	 * @see http://www.qrcode.com/en/about/version.html
	 *
	 * @var int [][][]
	 */
	private const MAX_LENGTH =[
	//	v  => [NUMERIC => [L, M, Q, H ], ALPHANUM => [L, M, Q, H], BINARY => [L, M, Q, H  ], KANJI => [L, M, Q, H   ]]
		1  => [[  41,   34,   27,   17], [  25,   20,   16,   10], [  17,   14,   11,    7], [  10,    8,    7,    4]],
		2  => [[  77,   63,   48,   34], [  47,   38,   29,   20], [  32,   26,   20,   14], [  20,   16,   12,    8]],
		3  => [[ 127,  101,   77,   58], [  77,   61,   47,   35], [  53,   42,   32,   24], [  32,   26,   20,   15]],
		4  => [[ 187,  149,  111,   82], [ 114,   90,   67,   50], [  78,   62,   46,   34], [  48,   38,   28,   21]],
		5  => [[ 255,  202,  144,  106], [ 154,  122,   87,   64], [ 106,   84,   60,   44], [  65,   52,   37,   27]],
		6  => [[ 322,  255,  178,  139], [ 195,  154,  108,   84], [ 134,  106,   74,   58], [  82,   65,   45,   36]],
		7  => [[ 370,  293,  207,  154], [ 224,  178,  125,   93], [ 154,  122,   86,   64], [  95,   75,   53,   39]],
		8  => [[ 461,  365,  259,  202], [ 279,  221,  157,  122], [ 192,  152,  108,   84], [ 118,   93,   66,   52]],
		9  => [[ 552,  432,  312,  235], [ 335,  262,  189,  143], [ 230,  180,  130,   98], [ 141,  111,   80,   60]],
		10 => [[ 652,  513,  364,  288], [ 395,  311,  221,  174], [ 271,  213,  151,  119], [ 167,  131,   93,   74]],
		11 => [[ 772,  604,  427,  331], [ 468,  366,  259,  200], [ 321,  251,  177,  137], [ 198,  155,  109,   85]],
		12 => [[ 883,  691,  489,  374], [ 535,  419,  296,  227], [ 367,  287,  203,  155], [ 226,  177,  125,   96]],
		13 => [[1022,  796,  580,  427], [ 619,  483,  352,  259], [ 425,  331,  241,  177], [ 262,  204,  149,  109]],
		14 => [[1101,  871,  621,  468], [ 667,  528,  376,  283], [ 458,  362,  258,  194], [ 282,  223,  159,  120]],
		15 => [[1250,  991,  703,  530], [ 758,  600,  426,  321], [ 520,  412,  292,  220], [ 320,  254,  180,  136]],
		16 => [[1408, 1082,  775,  602], [ 854,  656,  470,  365], [ 586,  450,  322,  250], [ 361,  277,  198,  154]],
		17 => [[1548, 1212,  876,  674], [ 938,  734,  531,  408], [ 644,  504,  364,  280], [ 397,  310,  224,  173]],
		18 => [[1725, 1346,  948,  746], [1046,  816,  574,  452], [ 718,  560,  394,  310], [ 442,  345,  243,  191]],
		19 => [[1903, 1500, 1063,  813], [1153,  909,  644,  493], [ 792,  624,  442,  338], [ 488,  384,  272,  208]],
		20 => [[2061, 1600, 1159,  919], [1249,  970,  702,  557], [ 858,  666,  482,  382], [ 528,  410,  297,  235]],
		21 => [[2232, 1708, 1224,  969], [1352, 1035,  742,  587], [ 929,  711,  509,  403], [ 572,  438,  314,  248]],
		22 => [[2409, 1872, 1358, 1056], [1460, 1134,  823,  640], [1003,  779,  565,  439], [ 618,  480,  348,  270]],
		23 => [[2620, 2059, 1468, 1108], [1588, 1248,  890,  672], [1091,  857,  611,  461], [ 672,  528,  376,  284]],
		24 => [[2812, 2188, 1588, 1228], [1704, 1326,  963,  744], [1171,  911,  661,  511], [ 721,  561,  407,  315]],
		25 => [[3057, 2395, 1718, 1286], [1853, 1451, 1041,  779], [1273,  997,  715,  535], [ 784,  614,  440,  330]],
		26 => [[3283, 2544, 1804, 1425], [1990, 1542, 1094,  864], [1367, 1059,  751,  593], [ 842,  652,  462,  365]],
		27 => [[3517, 2701, 1933, 1501], [2132, 1637, 1172,  910], [1465, 1125,  805,  625], [ 902,  692,  496,  385]],
		28 => [[3669, 2857, 2085, 1581], [2223, 1732, 1263,  958], [1528, 1190,  868,  658], [ 940,  732,  534,  405]],
		29 => [[3909, 3035, 2181, 1677], [2369, 1839, 1322, 1016], [1628, 1264,  908,  698], [1002,  778,  559,  430]],
		30 => [[4158, 3289, 2358, 1782], [2520, 1994, 1429, 1080], [1732, 1370,  982,  742], [1066,  843,  604,  457]],
		31 => [[4417, 3486, 2473, 1897], [2677, 2113, 1499, 1150], [1840, 1452, 1030,  790], [1132,  894,  634,  486]],
		32 => [[4686, 3693, 2670, 2022], [2840, 2238, 1618, 1226], [1952, 1538, 1112,  842], [1201,  947,  684,  518]],
		33 => [[4965, 3909, 2805, 2157], [3009, 2369, 1700, 1307], [2068, 1628, 1168,  898], [1273, 1002,  719,  553]],
		34 => [[5253, 4134, 2949, 2301], [3183, 2506, 1787, 1394], [2188, 1722, 1228,  958], [1347, 1060,  756,  590]],
		35 => [[5529, 4343, 3081, 2361], [3351, 2632, 1867, 1431], [2303, 1809, 1283,  983], [1417, 1113,  790,  605]],
		36 => [[5836, 4588, 3244, 2524], [3537, 2780, 1966, 1530], [2431, 1911, 1351, 1051], [1496, 1176,  832,  647]],
		37 => [[6153, 4775, 3417, 2625], [3729, 2894, 2071, 1591], [2563, 1989, 1423, 1093], [1577, 1224,  876,  673]],
		38 => [[6479, 5039, 3599, 2735], [3927, 3054, 2181, 1658], [2699, 2099, 1499, 1139], [1661, 1292,  923,  701]],
		39 => [[6743, 5313, 3791, 2927], [4087, 3220, 2298, 1774], [2809, 2213, 1579, 1219], [1729, 1362,  972,  750]],
		40 => [[7089, 5596, 3993, 3057], [4296, 3391, 2420, 1852], [2953, 2331, 1663, 1273], [1817, 1435, 1024,  784]],
	];

	/**
	 * ISO/IEC 18004:2000 Tables 13-22
	 *
	 * @see http://www.thonky.com/qr-code-tutorial/error-correction-table
	 */
	private const RSBLOCKS = [
		1  => [[ 7, [[ 1,  19], [ 0,   0]]], [10, [[ 1, 16], [ 0,  0]]], [13, [[ 1, 13], [ 0,  0]]], [17, [[ 1,  9], [ 0,  0]]]],
		2  => [[10, [[ 1,  34], [ 0,   0]]], [16, [[ 1, 28], [ 0,  0]]], [22, [[ 1, 22], [ 0,  0]]], [28, [[ 1, 16], [ 0,  0]]]],
		3  => [[15, [[ 1,  55], [ 0,   0]]], [26, [[ 1, 44], [ 0,  0]]], [18, [[ 2, 17], [ 0,  0]]], [22, [[ 2, 13], [ 0,  0]]]],
		4  => [[20, [[ 1,  80], [ 0,   0]]], [18, [[ 2, 32], [ 0,  0]]], [26, [[ 2, 24], [ 0,  0]]], [16, [[ 4,  9], [ 0,  0]]]],
		5  => [[26, [[ 1, 108], [ 0,   0]]], [24, [[ 2, 43], [ 0,  0]]], [18, [[ 2, 15], [ 2, 16]]], [22, [[ 2, 11], [ 2, 12]]]],
		6  => [[18, [[ 2,  68], [ 0,   0]]], [16, [[ 4, 27], [ 0,  0]]], [24, [[ 4, 19], [ 0,  0]]], [28, [[ 4, 15], [ 0,  0]]]],
		7  => [[20, [[ 2,  78], [ 0,   0]]], [18, [[ 4, 31], [ 0,  0]]], [18, [[ 2, 14], [ 4, 15]]], [26, [[ 4, 13], [ 1, 14]]]],
		8  => [[24, [[ 2,  97], [ 0,   0]]], [22, [[ 2, 38], [ 2, 39]]], [22, [[ 4, 18], [ 2, 19]]], [26, [[ 4, 14], [ 2, 15]]]],
		9  => [[30, [[ 2, 116], [ 0,   0]]], [22, [[ 3, 36], [ 2, 37]]], [20, [[ 4, 16], [ 4, 17]]], [24, [[ 4, 12], [ 4, 13]]]],
		10 => [[18, [[ 2,  68], [ 2,  69]]], [26, [[ 4, 43], [ 1, 44]]], [24, [[ 6, 19], [ 2, 20]]], [28, [[ 6, 15], [ 2, 16]]]],
		11 => [[20, [[ 4,  81], [ 0,   0]]], [30, [[ 1, 50], [ 4, 51]]], [28, [[ 4, 22], [ 4, 23]]], [24, [[ 3, 12], [ 8, 13]]]],
		12 => [[24, [[ 2,  92], [ 2,  93]]], [22, [[ 6, 36], [ 2, 37]]], [26, [[ 4, 20], [ 6, 21]]], [28, [[ 7, 14], [ 4, 15]]]],
		13 => [[26, [[ 4, 107], [ 0,   0]]], [22, [[ 8, 37], [ 1, 38]]], [24, [[ 8, 20], [ 4, 21]]], [22, [[12, 11], [ 4, 12]]]],
		14 => [[30, [[ 3, 115], [ 1, 116]]], [24, [[ 4, 40], [ 5, 41]]], [20, [[11, 16], [ 5, 17]]], [24, [[11, 12], [ 5, 13]]]],
		15 => [[22, [[ 5,  87], [ 1,  88]]], [24, [[ 5, 41], [ 5, 42]]], [30, [[ 5, 24], [ 7, 25]]], [24, [[11, 12], [ 7, 13]]]],
		16 => [[24, [[ 5,  98], [ 1,  99]]], [28, [[ 7, 45], [ 3, 46]]], [24, [[15, 19], [ 2, 20]]], [30, [[ 3, 15], [13, 16]]]],
		17 => [[28, [[ 1, 107], [ 5, 108]]], [28, [[10, 46], [ 1, 47]]], [28, [[ 1, 22], [15, 23]]], [28, [[ 2, 14], [17, 15]]]],
		18 => [[30, [[ 5, 120], [ 1, 121]]], [26, [[ 9, 43], [ 4, 44]]], [28, [[17, 22], [ 1, 23]]], [28, [[ 2, 14], [19, 15]]]],
		19 => [[28, [[ 3, 113], [ 4, 114]]], [26, [[ 3, 44], [11, 45]]], [26, [[17, 21], [ 4, 22]]], [26, [[ 9, 13], [16, 14]]]],
		20 => [[28, [[ 3, 107], [ 5, 108]]], [26, [[ 3, 41], [13, 42]]], [30, [[15, 24], [ 5, 25]]], [28, [[15, 15], [10, 16]]]],
		21 => [[28, [[ 4, 116], [ 4, 117]]], [26, [[17, 42], [ 0,  0]]], [28, [[17, 22], [ 6, 23]]], [30, [[19, 16], [ 6, 17]]]],
		22 => [[28, [[ 2, 111], [ 7, 112]]], [28, [[17, 46], [ 0,  0]]], [30, [[ 7, 24], [16, 25]]], [24, [[34, 13], [ 0,  0]]]],
		23 => [[30, [[ 4, 121], [ 5, 122]]], [28, [[ 4, 47], [14, 48]]], [30, [[11, 24], [14, 25]]], [30, [[16, 15], [14, 16]]]],
		24 => [[30, [[ 6, 117], [ 4, 118]]], [28, [[ 6, 45], [14, 46]]], [30, [[11, 24], [16, 25]]], [30, [[30, 16], [ 2, 17]]]],
		25 => [[26, [[ 8, 106], [ 4, 107]]], [28, [[ 8, 47], [13, 48]]], [30, [[ 7, 24], [22, 25]]], [30, [[22, 15], [13, 16]]]],
		26 => [[28, [[10, 114], [ 2, 115]]], [28, [[19, 46], [ 4, 47]]], [28, [[28, 22], [ 6, 23]]], [30, [[33, 16], [ 4, 17]]]],
		27 => [[30, [[ 8, 122], [ 4, 123]]], [28, [[22, 45], [ 3, 46]]], [30, [[ 8, 23], [26, 24]]], [30, [[12, 15], [28, 16]]]],
		28 => [[30, [[ 3, 117], [10, 118]]], [28, [[ 3, 45], [23, 46]]], [30, [[ 4, 24], [31, 25]]], [30, [[11, 15], [31, 16]]]],
		29 => [[30, [[ 7, 116], [ 7, 117]]], [28, [[21, 45], [ 7, 46]]], [30, [[ 1, 23], [37, 24]]], [30, [[19, 15], [26, 16]]]],
		30 => [[30, [[ 5, 115], [10, 116]]], [28, [[19, 47], [10, 48]]], [30, [[15, 24], [25, 25]]], [30, [[23, 15], [25, 16]]]],
		31 => [[30, [[13, 115], [ 3, 116]]], [28, [[ 2, 46], [29, 47]]], [30, [[42, 24], [ 1, 25]]], [30, [[23, 15], [28, 16]]]],
		32 => [[30, [[17, 115], [ 0,   0]]], [28, [[10, 46], [23, 47]]], [30, [[10, 24], [35, 25]]], [30, [[19, 15], [35, 16]]]],
		33 => [[30, [[17, 115], [ 1, 116]]], [28, [[14, 46], [21, 47]]], [30, [[29, 24], [19, 25]]], [30, [[11, 15], [46, 16]]]],
		34 => [[30, [[13, 115], [ 6, 116]]], [28, [[14, 46], [23, 47]]], [30, [[44, 24], [ 7, 25]]], [30, [[59, 16], [ 1, 17]]]],
		35 => [[30, [[12, 121], [ 7, 122]]], [28, [[12, 47], [26, 48]]], [30, [[39, 24], [14, 25]]], [30, [[22, 15], [41, 16]]]],
		36 => [[30, [[ 6, 121], [14, 122]]], [28, [[ 6, 47], [34, 48]]], [30, [[46, 24], [10, 25]]], [30, [[ 2, 15], [64, 16]]]],
		37 => [[30, [[17, 122], [ 4, 123]]], [28, [[29, 46], [14, 47]]], [30, [[49, 24], [10, 25]]], [30, [[24, 15], [46, 16]]]],
		38 => [[30, [[ 4, 122], [18, 123]]], [28, [[13, 46], [32, 47]]], [30, [[48, 24], [14, 25]]], [30, [[42, 15], [32, 16]]]],
		39 => [[30, [[20, 117], [ 4, 118]]], [28, [[40, 47], [ 7, 48]]], [30, [[43, 24], [22, 25]]], [30, [[10, 15], [67, 16]]]],
		40 => [[30, [[19, 118], [ 6, 119]]], [28, [[18, 47], [31, 48]]], [30, [[34, 24], [34, 25]]], [30, [[20, 15], [61, 16]]]],
	];

	private const TOTAL_CODEWORDS = [
		1  => 26,
		2  => 44,
		3  => 70,
		4  => 100,
		5  => 134,
		6  => 172,
		7  => 196,
		8  => 242,
		9  => 292,
		10 => 346,
		11 => 404,
		12 => 466,
		13 => 532,
		14 => 581,
		15 => 655,
		16 => 733,
		17 => 815,
		18 => 901,
		19 => 991,
		20 => 1085,
		21 => 1156,
		22 => 1258,
		23 => 1364,
		24 => 1474,
		25 => 1588,
		26 => 1706,
		27 => 1828,
		28 => 1921,
		29 => 2051,
		30 => 2185,
		31 => 2323,
		32 => 2465,
		33 => 2611,
		34 => 2761,
		35 => 2876,
		36 => 3034,
		37 => 3196,
		38 => 3362,
		39 => 3532,
		40 => 3706,
	];

	/**
	 * QR Code version number
	 */
	protected int $version;

	/**
	 * Version constructor.
	 *
	 * @throws \chillerlan\QRCode\QRCodeException
	 */
	public function __construct(int $version){

		if($version < 1 || $version > 40){
			throw new QRCodeException('invalid version number');
		}

		$this->version = $version;
	}

	/**
	 * returns the current version number
	 */
	public function getVersionNumber():int{
		return $this->version;
	}

	/**
	 * the matrix size for the given version
	 */
	public function getDimension():int{
		return $this->version * 4 + 17;
	}

	/**
	 * the version pattern for the given version
	 */
	public function getVersionPattern():?int{
		return self::VERSION_PATTERN[$this->version] ?? null;
	}

	/**
	 * the alignment patterns for the current version
	 *
	 * @return int[]
	 */
	public function getAlignmentPattern():array{
		return self::ALIGNMENT_PATTERN[$this->version];
	}

	/**
	 * the maximum character count for the given $mode and $eccLevel
	 */
	public function getMaxLengthForMode(int $mode, EccLevel $eccLevel):?int{
		return self::MAX_LENGTH[$this->version][$mode][$eccLevel->getOrdinal()] ?? null;
	}

	/**
	 * returns ECC block information for the given $version and $eccLevel
	 */
	public function getRSBlocks(EccLevel $eccLevel):array{
		return self::RSBLOCKS[$this->version][$eccLevel->getOrdinal()];
	}

	/**
	 * returns the maximum codewords for the current version
	 */
	public function getTotalCodewords():int{
		return self::TOTAL_CODEWORDS[$this->version];
	}


}
