<?php


namespace LearningRaph\Tools;

/**
 *
 * Functions to get infos about countries and languages
 *
 * @author    Raphaël Grasset
 * @copyright 2016 Raphaël Grasset
 * @license   Proprietary
 * @version   1.0
 */
class I18nHelper
{
    /**
     *
     * Return a list of 195 countries with country code/name/nationality/currency code/currency symbol/phone code
     *
     * @param string $language Language of the country name and nationality string to return
     *
     * @return array
     */
    public function countries($language = 'en')
    {
        $jsondata = file_get_contents('assets/i18n/' . $language . '/countries.json');
        $country = json_decode($jsondata, true);

        $jsondata = file_get_contents('assets/i18n/' . $language . '/nationalities.json');
        $nationality = json_decode($jsondata, true);

        $countries = [
            '--' => ['code' => '--', 'name' => '', 'nationality' => '', 'currency_code' => '-', 'currency_symbol' => '-', 'phone_code' => '-'],
            'AD' => ['code' => 'AD', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '376'],
            'AE' => ['code' => 'AE', 'name' => '', 'nationality' => '', 'currency_code' => 'AED', 'currency_symbol' => 'د.إ', 'phone_code' => '971'],
            'AF' => ['code' => 'AF', 'name' => '', 'nationality' => '', 'currency_code' => 'AFN', 'currency_symbol' => 'Af', 'phone_code' => '93'],
            'AL' => ['code' => 'AL', 'name' => '', 'nationality' => '', 'currency_code' => 'ALL', 'currency_symbol' => 'Lek', 'phone_code' => '355'],
            'AM' => ['code' => 'AM', 'name' => '', 'nationality' => '', 'currency_code' => 'AMD', 'currency_symbol' => '֏', 'phone_code' => '374'],
            'AO' => ['code' => 'AO', 'name' => '', 'nationality' => '', 'currency_code' => 'AOA', 'currency_symbol' => 'Kz', 'phone_code' => '244'],
            'AR' => ['code' => 'AR', 'name' => '', 'nationality' => '', 'currency_code' => 'ARS', 'currency_symbol' => '$', 'phone_code' => '54'],
            'AT' => ['code' => 'AT', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '43'],
            'AU' => ['code' => 'AU', 'name' => '', 'nationality' => '', 'currency_code' => 'AUD', 'currency_symbol' => 'A$', 'phone_code' => '61'],
            'AZ' => ['code' => 'AZ', 'name' => '', 'nationality' => '', 'currency_code' => 'AZN', 'currency_symbol' => 'm', 'phone_code' => '994'],
            'BA' => ['code' => 'BA', 'name' => '', 'nationality' => '', 'currency_code' => 'BAM', 'currency_symbol' => 'KM', 'phone_code' => '387'],
            'BB' => ['code' => 'BB', 'name' => '', 'nationality' => '', 'currency_code' => 'BBD', 'currency_symbol' => 'Bds$', 'phone_code' => '1246'],
            'BD' => ['code' => 'BD', 'name' => '', 'nationality' => '', 'currency_code' => 'BDT', 'currency_symbol' => '৳', 'phone_code' => '880'],
            'BE' => ['code' => 'BE', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '32'],
            'BF' => ['code' => 'BF', 'name' => '', 'nationality' => '', 'currency_code' => 'XOF', 'currency_symbol' => 'CFA', 'phone_code' => '226'],
            'BG' => ['code' => 'BG', 'name' => '', 'nationality' => '', 'currency_code' => 'BGN', 'currency_symbol' => 'лв', 'phone_code' => '359'],
            'BH' => ['code' => 'BH', 'name' => '', 'nationality' => '', 'currency_code' => 'BHD', 'currency_symbol' => 'BD', 'phone_code' => '973'],
            'BI' => ['code' => 'BI', 'name' => '', 'nationality' => '', 'currency_code' => 'BIF', 'currency_symbol' => 'FBu', 'phone_code' => '257'],
            'BJ' => ['code' => 'BJ', 'name' => '', 'nationality' => '', 'currency_code' => 'XOF', 'currency_symbol' => 'CFA', 'phone_code' => '229'],
            'BN' => ['code' => 'BN', 'name' => '', 'nationality' => '', 'currency_code' => 'BND', 'currency_symbol' => 'B$', 'phone_code' => '673'],
            'BO' => ['code' => 'BO', 'name' => '', 'nationality' => '', 'currency_code' => 'BOB', 'currency_symbol' => 'Bs.', 'phone_code' => '591'],
            'BR' => ['code' => 'BR', 'name' => '', 'nationality' => '', 'currency_code' => 'BRL', 'currency_symbol' => 'R$', 'phone_code' => '55'],
            'BS' => ['code' => 'BS', 'name' => '', 'nationality' => '', 'currency_code' => 'BSD', 'currency_symbol' => 'B$', 'phone_code' => '1242'],
            'BT' => ['code' => 'BT', 'name' => '', 'nationality' => '', 'currency_code' => 'INR', 'currency_symbol' => 'Rs.', 'phone_code' => '975'],
            'BW' => ['code' => 'BW', 'name' => '', 'nationality' => '', 'currency_code' => 'BWP', 'currency_symbol' => 'P', 'phone_code' => '267'],
            'BY' => ['code' => 'BY', 'name' => '', 'nationality' => '', 'currency_code' => 'BYR', 'currency_symbol' => 'Br', 'phone_code' => '375'],
            'BZ' => ['code' => 'BZ', 'name' => '', 'nationality' => '', 'currency_code' => 'BZD', 'currency_symbol' => 'BZ$', 'phone_code' => '501'],
            'CA' => ['code' => 'CA', 'name' => '', 'nationality' => '', 'currency_code' => 'CAD', 'currency_symbol' => 'C$', 'phone_code' => '1'],
            'CF' => ['code' => 'CF', 'name' => '', 'nationality' => '', 'currency_code' => 'XAF', 'currency_symbol' => 'FCFA', 'phone_code' => '236'],
            'CG' => ['code' => 'CG', 'name' => '', 'nationality' => '', 'currency_code' => 'XAF', 'currency_symbol' => 'FCFA', 'phone_code' => '242'],
            'CH' => ['code' => 'CH', 'name' => '', 'nationality' => '', 'currency_code' => 'CHF', 'currency_symbol' => 'SFr.', 'phone_code' => '41'],
            'CI' => ['code' => 'CI', 'name' => '', 'nationality' => '', 'currency_code' => 'XOF', 'currency_symbol' => 'CFA', 'phone_code' => '225'],
            'CK' => ['code' => 'CK', 'name' => '', 'nationality' => '', 'currency_code' => 'NZD', 'currency_symbol' => '$', 'phone_code' => '682'],
            'CL' => ['code' => 'CL', 'name' => '', 'nationality' => '', 'currency_code' => 'CLP', 'currency_symbol' => '$', 'phone_code' => '56'],
            'CM' => ['code' => 'CM', 'name' => '', 'nationality' => '', 'currency_code' => 'XAF', 'currency_symbol' => 'FCFA', 'phone_code' => '237'],
            'CN' => ['code' => 'CN', 'name' => '', 'nationality' => '', 'currency_code' => 'CNY', 'currency_symbol' => '¥', 'phone_code' => '86'],
            'CO' => ['code' => 'CO', 'name' => '', 'nationality' => '', 'currency_code' => 'COP', 'currency_symbol' => '¥', 'phone_code' => '57'],
            'CR' => ['code' => 'CR', 'name' => '', 'nationality' => '', 'currency_code' => 'CRC', 'currency_symbol' => '₡', 'phone_code' => '506'],
            'CU' => ['code' => 'CU', 'name' => '', 'nationality' => '', 'currency_code' => 'CUP', 'currency_symbol' => '$', 'phone_code' => '53'],
            'CV' => ['code' => 'CV', 'name' => '', 'nationality' => '', 'currency_code' => 'CVE', 'currency_symbol' => 'Esc', 'phone_code' => '238'],
            'CY' => ['code' => 'CY', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '357'],
            'CZ' => ['code' => 'CZ', 'name' => '', 'nationality' => '', 'currency_code' => 'CZK', 'currency_symbol' => 'Kč', 'phone_code' => '420'],
            'DE' => ['code' => 'DE', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '49'],
            'DJ' => ['code' => 'DJ', 'name' => '', 'nationality' => '', 'currency_code' => 'DJF', 'currency_symbol' => 'Fdj', 'phone_code' => '253'],
            'DK' => ['code' => 'DK', 'name' => '', 'nationality' => '', 'currency_code' => 'DKK', 'currency_symbol' => 'kr', 'phone_code' => '45'],
            'DO' => ['code' => 'DO', 'name' => '', 'nationality' => '', 'currency_code' => 'DOP', 'currency_symbol' => 'RD$', 'phone_code' => '1809'],
            'DZ' => ['code' => 'DZ', 'name' => '', 'nationality' => '', 'currency_code' => 'DZD', 'currency_symbol' => 'DA', 'phone_code' => '213'],
            'EC' => ['code' => 'EC', 'name' => '', 'nationality' => '', 'currency_code' => 'USD', 'currency_symbol' => '$', 'phone_code' => '593'],
            'EE' => ['code' => 'EE', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '372'],
            'EG' => ['code' => 'EG', 'name' => '', 'nationality' => '', 'currency_code' => 'EGP', 'currency_symbol' => 'E£', 'phone_code' => '20'],
            'EL' => ['code' => 'EL', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '30'],
            'ER' => ['code' => 'ER', 'name' => '', 'nationality' => '', 'currency_code' => 'ERN', 'currency_symbol' => 'Nfk', 'phone_code' => '291'],
            'ES' => ['code' => 'ES', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '34'],
            'ET' => ['code' => 'ET', 'name' => '', 'nationality' => '', 'currency_code' => 'ETB', 'currency_symbol' => 'Br', 'phone_code' => '251'],
            'FI' => ['code' => 'FI', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '358'],
            'FJ' => ['code' => 'FJ', 'name' => '', 'nationality' => '', 'currency_code' => 'FJD', 'currency_symbol' => 'FJ$', 'phone_code' => '679'],
            'FK' => ['code' => 'FK', 'name' => '', 'nationality' => '', 'currency_code' => 'FKP', 'currency_symbol' => '£', 'phone_code' => '500'],
            'FO' => ['code' => 'FO', 'name' => '', 'nationality' => '', 'currency_code' => 'DKK', 'currency_symbol' => 'kr', 'phone_code' => '298'],
            'FR' => ['code' => 'FR', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '33'],
            'GA' => ['code' => 'GA', 'name' => '', 'nationality' => '', 'currency_code' => 'XAF', 'currency_symbol' => 'FCFA', 'phone_code' => '241'],
            'GD' => ['code' => 'GD', 'name' => '', 'nationality' => '', 'currency_code' => 'XCD', 'currency_symbol' => '$', 'phone_code' => '1473'],
            'GE' => ['code' => 'GE', 'name' => '', 'nationality' => '', 'currency_code' => 'GEL', 'currency_symbol' => 'ლ', 'phone_code' => '995'],
            'GH' => ['code' => 'GH', 'name' => '', 'nationality' => '', 'currency_code' => 'GHS', 'currency_symbol' => 'GH¢', 'phone_code' => '233'],
            'GI' => ['code' => 'GI', 'name' => '', 'nationality' => '', 'currency_code' => 'GIP', 'currency_symbol' => '£', 'phone_code' => '350'],
            'GL' => ['code' => 'GL', 'name' => '', 'nationality' => '', 'currency_code' => 'DKK', 'currency_symbol' => 'kr', 'phone_code' => '299'],
            'GM' => ['code' => 'GM', 'name' => '', 'nationality' => '', 'currency_code' => 'GMD', 'currency_symbol' => 'D', 'phone_code' => '220'],
            'GN' => ['code' => 'GN', 'name' => '', 'nationality' => '', 'currency_code' => 'GNF', 'currency_symbol' => 'GFr', 'phone_code' => '224'],
            'GQ' => ['code' => 'GQ', 'name' => '', 'nationality' => '', 'currency_code' => 'XAF', 'currency_symbol' => 'FCFA', 'phone_code' => '240'],
            'GT' => ['code' => 'GT', 'name' => '', 'nationality' => '', 'currency_code' => 'GTQ', 'currency_symbol' => 'Q', 'phone_code' => '502'],
            'GU' => ['code' => 'GU', 'name' => '', 'nationality' => '', 'currency_code' => 'USD', 'currency_symbol' => '$', 'phone_code' => '1671'],
            'GW' => ['code' => 'GW', 'name' => '', 'nationality' => '', 'currency_code' => 'XOF', 'currency_symbol' => 'CFA', 'phone_code' => '245'],
            'GY' => ['code' => 'GY', 'name' => '', 'nationality' => '', 'currency_code' => 'GYD', 'currency_symbol' => '$', 'phone_code' => '592'],
            'HK' => ['code' => 'HK', 'name' => '', 'nationality' => '', 'currency_code' => 'HKD', 'currency_symbol' => 'HK$', 'phone_code' => '852'],
            'HN' => ['code' => 'HN', 'name' => '', 'nationality' => '', 'currency_code' => 'HNL', 'currency_symbol' => 'L', 'phone_code' => '504'],
            'HR' => ['code' => 'HR', 'name' => '', 'nationality' => '', 'currency_code' => 'HRK', 'currency_symbol' => 'kn', 'phone_code' => '385'],
            'HT' => ['code' => 'HT', 'name' => '', 'nationality' => '', 'currency_code' => 'HTG', 'currency_symbol' => 'G', 'phone_code' => '509'],
            'HU' => ['code' => 'HU', 'name' => '', 'nationality' => '', 'currency_code' => 'HUF', 'currency_symbol' => 'Ft', 'phone_code' => '36'],
            'ID' => ['code' => 'ID', 'name' => '', 'nationality' => '', 'currency_code' => 'IDR', 'currency_symbol' => 'Rp', 'phone_code' => '62'],
            'IE' => ['code' => 'IE', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '353'],
            'IL' => ['code' => 'IL', 'name' => '', 'nationality' => '', 'currency_code' => 'ILS', 'currency_symbol' => '₪', 'phone_code' => '972'],
            'IM' => ['code' => 'IM', 'name' => '', 'nationality' => '', 'currency_code' => 'IMP', 'currency_symbol' => '₪', 'phone_code' => '230'],
            'IN' => ['code' => 'IN', 'name' => '', 'nationality' => '', 'currency_code' => 'INR', 'currency_symbol' => '₹', 'phone_code' => '91'],
            'IQ' => ['code' => 'IQ', 'name' => '', 'nationality' => '', 'currency_code' => 'IQD', 'currency_symbol' => 'ع.د', 'phone_code' => '964'],
            'IR' => ['code' => 'IR', 'name' => '', 'nationality' => '', 'currency_code' => 'IRR', 'currency_symbol' => 'ریال', 'phone_code' => '98'],
            'IS' => ['code' => 'IS', 'name' => '', 'nationality' => '', 'currency_code' => 'ISK', 'currency_symbol' => 'kr', 'phone_code' => '354'],
            'IT' => ['code' => 'IT', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '39'],
            'JM' => ['code' => 'JM', 'name' => '', 'nationality' => '', 'currency_code' => 'JMD', 'currency_symbol' => '$', 'phone_code' => '1876'],
            'JO' => ['code' => 'JO', 'name' => '', 'nationality' => '', 'currency_code' => 'JOD', 'currency_symbol' => '-', 'phone_code' => '962'],
            'JP' => ['code' => 'JP', 'name' => '', 'nationality' => '', 'currency_code' => 'JPY', 'currency_symbol' => '¥', 'phone_code' => '81'],
            'KE' => ['code' => 'KE', 'name' => '', 'nationality' => '', 'currency_code' => 'KES', 'currency_symbol' => 'KSh', 'phone_code' => '254'],
            'KG' => ['code' => 'KG', 'name' => '', 'nationality' => '', 'currency_code' => 'KGS', 'currency_symbol' => 'лв', 'phone_code' => '996'],
            'KH' => ['code' => 'KH', 'name' => '', 'nationality' => '', 'currency_code' => 'KHR', 'currency_symbol' => 'Riel', 'phone_code' => '855'],
            'KM' => ['code' => 'KM', 'name' => '', 'nationality' => '', 'currency_code' => 'KMF', 'currency_symbol' => 'CF', 'phone_code' => '269'],
            'KP' => ['code' => 'KP', 'name' => '', 'nationality' => '', 'currency_code' => 'KPW', 'currency_symbol' => '₩', 'phone_code' => '850'],
            'KR' => ['code' => 'KR', 'name' => '', 'nationality' => '', 'currency_code' => 'KRW', 'currency_symbol' => '₩', 'phone_code' => '82'],
            'KW' => ['code' => 'KW', 'name' => '', 'nationality' => '', 'currency_code' => 'KWD', 'currency_symbol' => 'د.ك', 'phone_code' => '965'],
            'KY' => ['code' => 'KY', 'name' => '', 'nationality' => '', 'currency_code' => 'KYD', 'currency_symbol' => '$', 'phone_code' => '1345'],
            'KZ' => ['code' => 'KZ', 'name' => '', 'nationality' => '', 'currency_code' => 'KZT', 'currency_symbol' => '₸', 'phone_code' => '7'],
            'LA' => ['code' => 'LA', 'name' => '', 'nationality' => '', 'currency_code' => 'LAK', 'currency_symbol' => '₭', 'phone_code' => '856'],
            'LB' => ['code' => 'LB', 'name' => '', 'nationality' => '', 'currency_code' => 'LBP', 'currency_symbol' => 'ل.ل', 'phone_code' => '961'],
            'LI' => ['code' => 'LI', 'name' => '', 'nationality' => '', 'currency_code' => 'CHF', 'currency_symbol' => 'SFr.', 'phone_code' => '423'],
            'LK' => ['code' => 'LK', 'name' => '', 'nationality' => '', 'currency_code' => 'LKR', 'currency_symbol' => 'Rp', 'phone_code' => '94'],
            'LR' => ['code' => 'LR', 'name' => '', 'nationality' => '', 'currency_code' => 'LRD', 'currency_symbol' => 'L$', 'phone_code' => '231'],
            'LS' => ['code' => 'LS', 'name' => '', 'nationality' => '', 'currency_code' => 'LSL', 'currency_symbol' => 'L', 'phone_code' => '266'],
            'LT' => ['code' => 'LT', 'name' => '', 'nationality' => '', 'currency_code' => 'LTL', 'currency_symbol' => 'Lt', 'phone_code' => '370'],
            'LU' => ['code' => 'LU', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '352'],
            'LV' => ['code' => 'LV', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '371'],
            'LY' => ['code' => 'LY', 'name' => '', 'nationality' => '', 'currency_code' => 'LYD', 'currency_symbol' => 'LD', 'phone_code' => '218'],
            'MA' => ['code' => 'MA', 'name' => '', 'nationality' => '', 'currency_code' => 'MAD', 'currency_symbol' => '₧', 'phone_code' => '212'],
            'MC' => ['code' => 'MC', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '377'],
            'MD' => ['code' => 'MD', 'name' => '', 'nationality' => '', 'currency_code' => 'MDL', 'currency_symbol' => 'р.', 'phone_code' => '373'],
            'ME' => ['code' => 'ME', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '382'],
            'MG' => ['code' => 'MG', 'name' => '', 'nationality' => '', 'currency_code' => 'MGA', 'currency_symbol' => '-', 'phone_code' => '261'],
            'ML' => ['code' => 'ML', 'name' => '', 'nationality' => '', 'currency_code' => 'XOF', 'currency_symbol' => 'CFA', 'phone_code' => '223'],
            'MN' => ['code' => 'MN', 'name' => '', 'nationality' => '', 'currency_code' => 'MNT', 'currency_symbol' => '₮', 'phone_code' => '976'],
            'MO' => ['code' => 'MO', 'name' => '', 'nationality' => '', 'currency_code' => 'MOP', 'currency_symbol' => 'MOP$', 'phone_code' => '853'],
            'MP' => ['code' => 'MP', 'name' => '', 'nationality' => '', 'currency_code' => 'USD', 'currency_symbol' => '$', 'phone_code' => '1670'],
            'MQ' => ['code' => 'MQ', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '596'],
            'MR' => ['code' => 'MR', 'name' => '', 'nationality' => '', 'currency_code' => 'MRO', 'currency_symbol' => 'UM', 'phone_code' => '222'],
            'MT' => ['code' => 'MT', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '356'],
            'MU' => ['code' => 'MU', 'name' => '', 'nationality' => '', 'currency_code' => 'MUR', 'currency_symbol' => 'R', 'phone_code' => '382'],
            'MV' => ['code' => 'MV', 'name' => '', 'nationality' => '', 'currency_code' => 'MVR', 'currency_symbol' => 'MRf', 'phone_code' => '960'],
            'MW' => ['code' => 'MW', 'name' => '', 'nationality' => '', 'currency_code' => 'MWK', 'currency_symbol' => 'MK', 'phone_code' => '265'],
            'MX' => ['code' => 'MX', 'name' => '', 'nationality' => '', 'currency_code' => 'MXN', 'currency_symbol' => 'Mex$', 'phone_code' => '52'],
            'MY' => ['code' => 'MY', 'name' => '', 'nationality' => '', 'currency_code' => 'MYR', 'currency_symbol' => 'RM', 'phone_code' => '60'],
            'MZ' => ['code' => 'MZ', 'name' => '', 'nationality' => '', 'currency_code' => 'MZN', 'currency_symbol' => 'MTn', 'phone_code' => '258'],
            'NA' => ['code' => 'NA', 'name' => '', 'nationality' => '', 'currency_code' => 'NAD', 'currency_symbol' => 'N$', 'phone_code' => '264'],
            'NC' => ['code' => 'NC', 'name' => '', 'nationality' => '', 'currency_code' => 'XPF', 'currency_symbol' => 'F', 'phone_code' => '687'],
            'NE' => ['code' => 'NE', 'name' => '', 'nationality' => '', 'currency_code' => 'XOF', 'currency_symbol' => 'CFA', 'phone_code' => '227'],
            'NG' => ['code' => 'NG', 'name' => '', 'nationality' => '', 'currency_code' => 'NGN', 'currency_symbol' => '₦', 'phone_code' => '234'],
            'NI' => ['code' => 'NI', 'name' => '', 'nationality' => '', 'currency_code' => 'NIO', 'currency_symbol' => 'C$', 'phone_code' => '505'],
            'NL' => ['code' => 'NL', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '31'],
            'NO' => ['code' => 'NO', 'name' => '', 'nationality' => '', 'currency_code' => 'NOK', 'currency_symbol' => 'kr', 'phone_code' => '47'],
            'NP' => ['code' => 'NP', 'name' => '', 'nationality' => '', 'currency_code' => 'NPR', 'currency_symbol' => 'Rs.', 'phone_code' => '977'],
            'NR' => ['code' => 'NR', 'name' => '', 'nationality' => '', 'currency_code' => 'AUD', 'currency_symbol' => 'A$', 'phone_code' => '674'],
            'NZ' => ['code' => 'NZ', 'name' => '', 'nationality' => '', 'currency_code' => 'NZD', 'currency_symbol' => '$', 'phone_code' => '64'],
            'OM' => ['code' => 'OM', 'name' => '', 'nationality' => '', 'currency_code' => 'OMR', 'currency_symbol' => 'ر.ع.', 'phone_code' => '968'],
            'PA' => ['code' => 'PA', 'name' => '', 'nationality' => '', 'currency_code' => 'PAB', 'currency_symbol' => 'B/.', 'phone_code' => '507'],
            'PE' => ['code' => 'PE', 'name' => '', 'nationality' => '', 'currency_code' => 'PEN', 'currency_symbol' => 'S/.', 'phone_code' => '51'],
            'PG' => ['code' => 'PG', 'name' => '', 'nationality' => '', 'currency_code' => 'PGK', 'currency_symbol' => 'K', 'phone_code' => '675'],
            'PH' => ['code' => 'PH', 'name' => '', 'nationality' => '', 'currency_code' => 'PHP', 'currency_symbol' => '₱', 'phone_code' => '63'],
            'PK' => ['code' => 'PK', 'name' => '', 'nationality' => '', 'currency_code' => 'PKR', 'currency_symbol' => 'Rs', 'phone_code' => '92'],
            'PL' => ['code' => 'PL', 'name' => '', 'nationality' => '', 'currency_code' => 'PLN', 'currency_symbol' => 'zł', 'phone_code' => '48'],
            'PR' => ['code' => 'PR', 'name' => '', 'nationality' => '', 'currency_code' => 'USD', 'currency_symbol' => '$', 'phone_code' => '1787'],
            'PS' => ['code' => 'PS', 'name' => '', 'nationality' => '', 'currency_code' => 'ILS', 'currency_symbol' => '₪', 'phone_code' => '970'],
            'PT' => ['code' => 'PT', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '351'],
            'PW' => ['code' => 'PW', 'name' => '', 'nationality' => '', 'currency_code' => 'USD', 'currency_symbol' => '$', 'phone_code' => '680'],
            'PY' => ['code' => 'PY', 'name' => '', 'nationality' => '', 'currency_code' => 'PYG', 'currency_symbol' => '₲', 'phone_code' => '595'],
            'QA' => ['code' => 'QA', 'name' => '', 'nationality' => '', 'currency_code' => 'QAR', 'currency_symbol' => 'QR', 'phone_code' => '974'],
            'RO' => ['code' => 'RO', 'name' => '', 'nationality' => '', 'currency_code' => 'RON', 'currency_symbol' => 'lei', 'phone_code' => '40'],
            'RS' => ['code' => 'RS', 'name' => '', 'nationality' => '', 'currency_code' => 'RSD', 'currency_symbol' => 'RSD', 'phone_code' => '381'],
            'RU' => ['code' => 'RU', 'name' => '', 'nationality' => '', 'currency_code' => 'RUB', 'currency_symbol' => 'руб.', 'phone_code' => '7'],
            'RW' => ['code' => 'RW', 'name' => '', 'nationality' => '', 'currency_code' => 'RWF', 'currency_symbol' => 'RF', 'phone_code' => '250'],
            'SA' => ['code' => 'SA', 'name' => '', 'nationality' => '', 'currency_code' => 'SAR', 'currency_symbol' => 'SR', 'phone_code' => '966'],
            'SC' => ['code' => 'SC', 'name' => '', 'nationality' => '', 'currency_code' => 'SCR', 'currency_symbol' => 'SR ', 'phone_code' => '248'],
            'SD' => ['code' => 'SD', 'name' => '', 'nationality' => '', 'currency_code' => 'SDG', 'currency_symbol' => '-', 'phone_code' => '249'],
            'SE' => ['code' => 'SE', 'name' => '', 'nationality' => '', 'currency_code' => 'SEK', 'currency_symbol' => 'kr', 'phone_code' => '46'],
            'SG' => ['code' => 'SG', 'name' => '', 'nationality' => '', 'currency_code' => 'SGD', 'currency_symbol' => 'S$', 'phone_code' => '65'],
            'SI' => ['code' => 'SI', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '386'],
            'SK' => ['code' => 'SK', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '421'],
            'SL' => ['code' => 'SL', 'name' => '', 'nationality' => '', 'currency_code' => 'SLL', 'currency_symbol' => 'Le', 'phone_code' => '232'],
            'SN' => ['code' => 'SN', 'name' => '', 'nationality' => '', 'currency_code' => 'XOF', 'currency_symbol' => 'CFA', 'phone_code' => '221'],
            'SO' => ['code' => 'SO', 'name' => '', 'nationality' => '', 'currency_code' => 'SOS', 'currency_symbol' => ' So.', 'phone_code' => '252'],
            'SR' => ['code' => 'SR', 'name' => '', 'nationality' => '', 'currency_code' => 'SRD', 'currency_symbol' => '$', 'phone_code' => '597'],
            'SS' => ['code' => 'SS', 'name' => '', 'nationality' => '', 'currency_code' => 'SSP', 'currency_symbol' => '$', 'phone_code' => '249'],
            'SV' => ['code' => 'SV', 'name' => '', 'nationality' => '', 'currency_code' => 'SVC', 'currency_symbol' => '¢', 'phone_code' => '503'],
            'SY' => ['code' => 'SY', 'name' => '', 'nationality' => '', 'currency_code' => 'SYP', 'currency_symbol' => '£', 'phone_code' => '963'],
            'SZ' => ['code' => 'SZ', 'name' => '', 'nationality' => '', 'currency_code' => 'SZL', 'currency_symbol' => 'L', 'phone_code' => '268'],
            'TD' => ['code' => 'TD', 'name' => '', 'nationality' => '', 'currency_code' => 'XAF', 'currency_symbol' => 'FCFA', 'phone_code' => '235'],
            'TG' => ['code' => 'TG', 'name' => '', 'nationality' => '', 'currency_code' => 'XOF', 'currency_symbol' => 'CFA', 'phone_code' => '228'],
            'TH' => ['code' => 'TH', 'name' => '', 'nationality' => '', 'currency_code' => 'THB', 'currency_symbol' => '฿', 'phone_code' => '66'],
            'TJ' => ['code' => 'TJ', 'name' => '', 'nationality' => '', 'currency_code' => 'TJS', 'currency_symbol' => '-', 'phone_code' => '992'],
            'TM' => ['code' => 'TM', 'name' => '', 'nationality' => '', 'currency_code' => 'TMT', 'currency_symbol' => 'm', 'phone_code' => '993'],
            'TN' => ['code' => 'TN', 'name' => '', 'nationality' => '', 'currency_code' => 'TND', 'currency_symbol' => 'DT', 'phone_code' => '216'],
            'TO' => ['code' => 'TO', 'name' => '', 'nationality' => '', 'currency_code' => 'TOP', 'currency_symbol' => ' T$', 'phone_code' => '676'],
            'TR' => ['code' => 'TR', 'name' => '', 'nationality' => '', 'currency_code' => 'TRY', 'currency_symbol' => 'TL', 'phone_code' => '90'],
            'TW' => ['code' => 'TW', 'name' => '', 'nationality' => '', 'currency_code' => 'TWD', 'currency_symbol' => 'NT$', 'phone_code' => '886'],
            'TZ' => ['code' => 'TZ', 'name' => '', 'nationality' => '', 'currency_code' => 'TZS', 'currency_symbol' => 'x/y', 'phone_code' => '255'],
            'UA' => ['code' => 'UA', 'name' => '', 'nationality' => '', 'currency_code' => 'UAH', 'currency_symbol' => '₴', 'phone_code' => '380'],
            'UG' => ['code' => 'UG', 'name' => '', 'nationality' => '', 'currency_code' => 'UGX', 'currency_symbol' => 'USh', 'phone_code' => '256'],
            'UK' => ['code' => 'UK', 'name' => '', 'nationality' => '', 'currency_code' => 'GBP', 'currency_symbol' => '£', 'phone_code' => '44'],
            'US' => ['code' => 'US', 'name' => '', 'nationality' => '', 'currency_code' => 'USD', 'currency_symbol' => '$', 'phone_code' => '1'],
            'UY' => ['code' => 'UY', 'name' => '', 'nationality' => '', 'currency_code' => 'UYU', 'currency_symbol' => '$', 'phone_code' => '598'],
            'UZ' => ['code' => 'UZ', 'name' => '', 'nationality' => '', 'currency_code' => 'UZS', 'currency_symbol' => 'сўм', 'phone_code' => '998'],
            'VA' => ['code' => 'VA', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '379'],
            'VE' => ['code' => 'VE', 'name' => '', 'nationality' => '', 'currency_code' => 'VEF', 'currency_symbol' => 'Bs. F', 'phone_code' => '58'],
            'VN' => ['code' => 'VN', 'name' => '', 'nationality' => '', 'currency_code' => 'VND', 'currency_symbol' => '₫', 'phone_code' => '84'],
            'VU' => ['code' => 'VU', 'name' => '', 'nationality' => '', 'currency_code' => 'VUV', 'currency_symbol' => 'Vt', 'phone_code' => '678'],
            'WF' => ['code' => 'WF', 'name' => '', 'nationality' => '', 'currency_code' => 'XPF', 'currency_symbol' => 'F', 'phone_code' => '681'],
            'YE' => ['code' => 'YE', 'name' => '', 'nationality' => '', 'currency_code' => 'YER', 'currency_symbol' => '-', 'phone_code' => '967'],
            'YT' => ['code' => 'YT', 'name' => '', 'nationality' => '', 'currency_code' => 'EUR', 'currency_symbol' => '€', 'phone_code' => '269'],
            'ZA' => ['code' => 'ZA', 'name' => '', 'nationality' => '', 'currency_code' => 'ZAR', 'currency_symbol' => 'R', 'phone_code' => '27'],
            'ZM' => ['code' => 'ZM', 'name' => '', 'nationality' => '', 'currency_code' => 'ZMW', 'currency_symbol' => 'ZK', 'phone_code' => '260'],
            'ZW' => ['code' => 'ZW', 'name' => '', 'nationality' => '', 'currency_code' => 'ZWL', 'currency_symbol' => 'ZK', 'phone_code' => '263'],
        ];

        foreach ($countries as $key => $row) {
            $countries[$key]['name'] = $country[$key];
            $countries[$key]['nationality'] = $nationality[$key];
        }

        return $countries;
    }

    /**
     *
     * Returns a list of languages with iso2/iso3/name/charset/direction
     * All languages codes can be found here :
     *   - http://www.loc.gov/standards/iso639-2/php/code_list.php
     *   - http://publications.europa.eu/code/en/en-5000500.htm
     *
     * @param string $language Language of the language string to return
     *
     * @return array
     */
    public function languages($language = 'en')
    {
        $jsondata = file_get_contents('assets/i18n/' . $language . '/languages.json');
        $lang = json_decode($jsondata, true);

        $languages = [
            '--' => ['iso2' => '--', 'iso3' => '---', 'language' => '', 'natural' => 'Other', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'af' => ['iso2' => 'af', 'iso3' => 'afr', 'language' => '', 'natural' => 'Afrikaans', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'ar' => ['iso2' => 'ar', 'iso3' => 'ara', 'language' => '', 'natural' => 'العربية', 'charset' => 'utf-8', 'direction' => 'rtl'],
            'bg' => ['iso2' => 'bg', 'iso3' => 'bul', 'language' => '', 'natural' => 'български език', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'bo' => ['iso2' => 'bo', 'iso3' => 'bod', 'language' => '', 'natural' => 'བོད་ཡིག', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'bs' => ['iso2' => 'bs', 'iso3' => 'bos', 'language' => '', 'natural' => 'Bosanski jezik', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'ca' => ['iso2' => 'ca', 'iso3' => 'cat', 'language' => '', 'natural' => 'Català', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'cs' => ['iso2' => 'cs', 'iso3' => 'ces', 'language' => '', 'natural' => 'česky', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'da' => ['iso2' => 'da', 'iso3' => 'dan', 'language' => '', 'natural' => 'Dansk', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'de' => ['iso2' => 'de', 'iso3' => 'deu', 'language' => '', 'natural' => 'Deutsch', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'el' => ['iso2' => 'el', 'iso3' => 'gre', 'language' => '', 'natural' => 'Ελληνικά', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'en' => ['iso2' => 'en', 'iso3' => 'eng', 'language' => '', 'natural' => 'English', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'es' => ['iso2' => 'es', 'iso3' => 'spa', 'language' => '', 'natural' => 'Español', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'et' => ['iso2' => 'et', 'iso3' => 'est', 'language' => '', 'natural' => 'Eesti', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'eu' => ['iso2' => 'eu', 'iso3' => 'eus', 'language' => '', 'natural' => 'Euskara', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'fa' => ['iso2' => 'fa', 'iso3' => 'per', 'language' => '', 'natural' => 'فارسی', 'charset' => 'utf-8', 'direction' => 'rtl'],
            'fi' => ['iso2' => 'fi', 'iso3' => 'fin', 'language' => '', 'natural' => 'Suomi', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'fr' => ['iso2' => 'fr', 'iso3' => 'fra', 'language' => '', 'natural' => 'Français', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'ga' => ['iso2' => 'ga', 'iso3' => 'gle', 'language' => '', 'natural' => 'Gaeilge', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'gd' => ['iso2' => 'gd', 'iso3' => 'gla', 'language' => '', 'natural' => 'Gàidhlig', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'he' => ['iso2' => 'he', 'iso3' => 'heb', 'language' => '', 'natural' => 'עברית', 'charset' => 'utf-8', 'direction' => 'rtl'],
            'hi' => ['iso2' => 'hi', 'iso3' => 'hin', 'language' => '', 'natural' => 'हिन्दी', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'hr' => ['iso2' => 'hr', 'iso3' => 'hrv', 'language' => '', 'natural' => 'hrvatski', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'hu' => ['iso2' => 'hu', 'iso3' => 'hun', 'language' => '', 'natural' => 'Magyar', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'hy' => ['iso2' => 'hy', 'iso3' => 'hye', 'language' => '', 'natural' => 'Հայերեն', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'id' => ['iso2' => 'id', 'iso3' => 'ind', 'language' => '', 'natural' => 'Bahasa Indonesia', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'is' => ['iso2' => 'is', 'iso3' => 'isl', 'language' => '', 'natural' => 'Íslenska', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'it' => ['iso2' => 'it', 'iso3' => 'ita', 'language' => '', 'natural' => 'Italiano', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'ja' => ['iso2' => 'ja', 'iso3' => 'jpn', 'language' => '', 'natural' => '日本語', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'ko' => ['iso2' => 'ko', 'iso3' => 'kor', 'language' => '', 'natural' => '한국어', 'charset' => 'kr', 'direction' => 'ltr'],
            'lt' => ['iso2' => 'lt', 'iso3' => 'lit', 'language' => '', 'natural' => 'Lietuvių kalba', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'lv' => ['iso2' => 'lv', 'iso3' => 'lav', 'language' => '', 'natural' => 'Latviešu valoda', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'mk' => ['iso2' => 'mk', 'iso3' => 'mkd', 'language' => '', 'natural' => 'македонски јазик', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'ms' => ['iso2' => 'ms', 'iso3' => 'msa', 'language' => '', 'natural' => 'Bahasa Melayu', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'mt' => ['iso2' => 'mt', 'iso3' => 'mlt', 'language' => '', 'natural' => 'Malti', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'nl' => ['iso2' => 'nl', 'iso3' => 'nld', 'language' => '', 'natural' => 'Vlaams', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'no' => ['iso2' => 'no', 'iso3' => 'nor', 'language' => '', 'natural' => 'Norsk', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'pl' => ['iso2' => 'pl', 'iso3' => 'pol', 'language' => '', 'natural' => 'Polski', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'pt' => ['iso2' => 'pt', 'iso3' => 'por', 'language' => '', 'natural' => 'Português', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'ro' => ['iso2' => 'ro', 'iso3' => 'ron', 'language' => '', 'natural' => 'Română', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'ru' => ['iso2' => 'ru', 'iso3' => 'rus', 'language' => '', 'natural' => 'Pусский язык', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'sk' => ['iso2' => 'sk', 'iso3' => 'slk', 'language' => '', 'natural' => 'Slovenčina', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'sl' => ['iso2' => 'sl', 'iso3' => 'slv', 'language' => '', 'natural' => 'Slovenščina', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'sq' => ['iso2' => 'sq', 'iso3' => 'sqi', 'language' => '', 'natural' => 'Shqip', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'sr' => ['iso2' => 'sr', 'iso3' => 'srp', 'language' => '', 'natural' => 'српски језик', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'sv' => ['iso2' => 'sv', 'iso3' => 'swe', 'language' => '', 'natural' => 'Svenska', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'th' => ['iso2' => 'th', 'iso3' => 'tha', 'language' => '', 'natural' => 'ไทย', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'tr' => ['iso2' => 'tr', 'iso3' => 'tur', 'language' => '', 'natural' => 'Türkçe', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'uk' => ['iso2' => 'uk', 'iso3' => 'ukr', 'language' => '', 'natural' => 'українська', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'ur' => ['iso2' => 'ur', 'iso3' => 'urd', 'language' => '', 'natural' => 'اردو', 'charset' => 'utf-8', 'direction' => 'rtl'],
            'vi' => ['iso2' => 'vi', 'iso3' => 'vie', 'language' => '', 'natural' => 'Tiếng Việt', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'yi' => ['iso2' => 'yi', 'iso3' => 'yid', 'language' => '', 'natural' => 'ייִדיש', 'charset' => 'utf-8', 'direction' => 'ltr'],
            'zh' => ['iso2' => 'zh', 'iso3' => 'zho', 'language' => '', 'natural' => '中文語', 'charset' => 'utf-8', 'direction' => 'ltr'],
        ];

        foreach ($languages as $key => $row) {
            $languages[$key]['language'] = $lang[$key];
        }

        return $languages;
    }
}
