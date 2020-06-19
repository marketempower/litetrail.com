<?php
// php generate.php > ../../../content/gearlists/v202006.html

setlocale(LC_MONETARY, 'en_US');

function generate($version, $completeTitle, $footnote, $basepackTitle, $carriedTitle, $carriedData, $backpackTitle, $backpackData, $shelterTitle, $shelterData, $sleepingTitle, $sleepingData, $clothingTitle, $clothingData, $gearTitle, $gearData, $consumablesTitle, $consumablesData)
{
    $s = '<table class="table-gearlist">'.PHP_EOL;

    /**
     * **************************************************
     * Title
     * **************************************************
     */
    $s .= tableRowTitle($version);

    /**
     * **************************************************
     * Carried
     * **************************************************
     */
    $s .= tableRowHeader($carriedTitle);

    $carriedCost = 0;
    $carriedWeight = 0;
    $d = sizeof($carriedData);
    for ($i=0; $i < $d ; $i++)
    {
        $s .= tableRowItem(
            $carriedData[$i][0], // Item
            $carriedData[$i][1], // Desc
            toMoneyFormat($carriedData[$i][2]), // Cost
            toWeightFormat($carriedData[$i][3]) // Weight
        );

        $carriedCost += $carriedData[$i][2]; // Total Cost
        $carriedWeight += $carriedData[$i][3]; // Total Weight
    }

    $s .= tableRowTotal(
        $carriedTitle,
        toMoneyFormat($carriedCost),
        toWeightFormat($carriedWeight)
    );

    /**
     * **************************************************
     * Base Pack: Backpack
     * **************************************************
     */
    $s .= tableRowSubHeader($backpackTitle);

    $backpackCost = 0;
    $backpackWeight = 0;
    $s .= tableRowItem(
        $backpackData[0], // Item
        $backpackData[1], // Desc
        toMoneyFormat($backpackData[2]), // Cost
        toWeightFormat($backpackData[3]) // Weight
    );

    $backpackCost += $backpackData[2]; // Total Cost
    $backpackWeight += $backpackData[3]; // Total Weight

    $s .= tableRowTotal(
        $backpackTitle,
        toMoneyFormat($backpackCost),
        toWeightFormat($backpackWeight)
    );

    /**
     * **************************************************
     * Base Pack: Shelter
     * **************************************************
     */
    $s .= tableRowSubHeader($shelterTitle);

    $shelterCost = 0;
    $shelterWeight = 0;
    $d = sizeof($shelterData);
    for ($i=0; $i < $d ; $i++)
    {
        $s .= tableRowItem(
            $shelterData[$i][0], // Item
            $shelterData[$i][1], // Desc
            toMoneyFormat($shelterData[$i][2]), // Cost
            toWeightFormat($shelterData[$i][3]) // Weight
        );

        $shelterCost += $shelterData[$i][2]; // Total Cost
        $shelterWeight += $shelterData[$i][3]; // Total Weight
    }

    $s .= tableRowTotal(
        $shelterTitle,
        toMoneyFormat($shelterCost),
        toWeightFormat($shelterWeight)
    );

    /**
     * **************************************************
     * Base Pack: Sleeping
     * **************************************************
     */
    $s .= tableRowSubHeader($sleepingTitle);

    $sleepingCost = 0;
    $sleepingWeight = 0;
    $d = sizeof($sleepingData);
    for ($i=0; $i < $d ; $i++)
    {
        $s .= tableRowItem(
            $sleepingData[$i][0], // Item
            $sleepingData[$i][1], // Desc
            toMoneyFormat($sleepingData[$i][2]), // Cost
            toWeightFormat($sleepingData[$i][3]) // Weight
        );

        $sleepingCost += $sleepingData[$i][2]; // Total Cost
        $sleepingWeight += $sleepingData[$i][3]; // Total Weight
    }

    $s .= tableRowTotal(
        $sleepingTitle,
        toMoneyFormat($sleepingCost),
        toWeightFormat($sleepingWeight)
    );

    /**
     * **************************************************
     * Base Pack: Clothing
     * **************************************************
     */
    $s .= tableRowSubHeader($clothingTitle);

    $clothingCost = 0;
    $clothingWeight = 0;
    $d = sizeof($clothingData);
    for ($i=0; $i < $d ; $i++)
    {
        $s .= tableRowItem(
            $clothingData[$i][0], // Item
            $clothingData[$i][1], // Desc
            toMoneyFormat($clothingData[$i][2]), // Cost
            toWeightFormat($clothingData[$i][3]) // Weight
        );

        $clothingCost += $clothingData[$i][2]; // Total Cost
        $clothingWeight += $clothingData[$i][3]; // Total Weight
    }

    $s .= tableRowTotal(
        $clothingTitle,
        toMoneyFormat($clothingCost),
        toWeightFormat($clothingWeight)
    );

    /**
     * **************************************************
     * Base Pack: Gear
     * **************************************************
     */
    $s .= tableRowSubHeader($gearTitle);

    $gearCost = 0;
    $gearWeight = 0;
    $d = sizeof($gearData);
    for ($i=0; $i < $d ; $i++)
    {
        $s .= tableRowItem(
            $gearData[$i][0], // Item
            $gearData[$i][1], // Desc
            toMoneyFormat($gearData[$i][2]), // Cost
            toWeightFormat($gearData[$i][3]) // Weight
        );

        $gearCost += $gearData[$i][2]; // Total Cost
        $gearWeight += $gearData[$i][3]; // Total Weight
    }

    $s .= tableRowTotal(
        $gearTitle,
        toMoneyFormat($gearCost),
        toWeightFormat($gearWeight)
    );

    /**
     * **************************************************
     * Base Pack: Total
     * **************************************************
     */
    $s .= tableRowTotal(
        $basepackTitle,
        toMoneyFormat(
            $backpackCost +
            $shelterCost +
            $sleepingCost +
            $clothingCost +
            $gearCost),
        toWeightFormat(
            $backpackWeight +
            $shelterWeight +
            $sleepingWeight +
            $clothingWeight +
            $gearWeight,
            'lb')
    );

    /**
     * **************************************************
     * Consumables
     * **************************************************
     */
    $s .= tableRowSubHeader($consumablesTitle);

    $consumablesCost = 0;
    $consumablesWeight = 0;
    $d = sizeof($consumablesData);
    for ($i=0; $i < $d ; $i++)
    {
        $s .= tableRowItem(
            $consumablesData[$i][0], // Item
            $consumablesData[$i][1], // Desc
            toMoneyFormat($consumablesData[$i][2]), // Cost
            toWeightFormat($consumablesData[$i][3]) // Weight
        );

        $consumablesCost += $consumablesData[$i][2]; // Total Cost
        $consumablesWeight += $consumablesData[$i][3]; // Total Weight
    }

    $s .= tableRowTotal(
        $consumablesTitle,
        toMoneyFormat($consumablesCost),
        toWeightFormat($consumablesWeight)
    );

     /**
     * **************************************************
     * Grand Total
     * **************************************************
     */
    $s .= tableRowFinal(
        $completeTitle,
        $footnote,
        toMoneyFormat(
            $carriedCost +
            $backpackCost +
            $shelterCost +
            $sleepingCost +
            $clothingCost +
            $gearCost +
            $consumablesCost),
        toWeightFormat(
            $carriedWeight +
            $backpackWeight +
            $shelterWeight +
            $sleepingWeight +
            $clothingWeight +
            $gearWeight +
            $consumablesWeight,
            'lb')
    );

    $s .= '</table>';

    return $s;
}

function getMoneyFormat()
{
    return '%.2n';
}

function toMoneyFormat($number, array $options = [])
{
    if ( ! array_key_exists('format', $options))
    {
        $options['format'] = getMoneyFormat();
    }

    return money_format($options['format'], $number);
}

function toWeightFormat($number, $metric = 'oz')
{
    if ($metric == 'lb')
    {
        $number = $number / 16;
    }

    return number_format($number, 2).$metric;
}

function tableRowTitle($version)
{
    $s = '<tr>'.PHP_EOL;
    $s .= '<td colspan="4" class="border-0">'.PHP_EOL;
    $s .= '<h3 class="text-2xl text-center">Ultralight Backpacking Gear List</h3>'.PHP_EOL;
    $s .= '<p class="text-sm text-center mb-2"><a href="https://www.litetrail.com/ultralight-backpacking-gear-list">litetrail.com/ultralight-backpacking-gear-list</a> &#8226; <span class="text-gray-700">'.$version.'</span></p>'.PHP_EOL;
    $s .= '</td>'.PHP_EOL;
    $s .= '</tr>'.PHP_EOL;

    return $s;
}

function tableRowHeader($title)
{
    $s = '<tr>'.PHP_EOL;
    $s .= '<th colspan="2" class="border-b border-r">'.$title.'</th>'.PHP_EOL;
    $s .= '<th class="border border-t-0 text-right">Cost</th>'.PHP_EOL;
    $s .= '<th class="border-b border-l text-right">Weight</th>'.PHP_EOL;
    $s .= '</tr>'.PHP_EOL;

    return $s;
}

function tableRowSubHeader($title)
{
    $s = '<tr>'.PHP_EOL;
    $s .= '<th colspan="4" class="border-b">'.$title.'</th>'.PHP_EOL;
    $s .= '</tr>'.PHP_EOL;

    return $s;
}

function tableRowItem($item, $desc, $cost, $weight)
{
    $s = '<tr>'.PHP_EOL;
    $s .= '<td class="border border-l-0">'.$item.'</td>'.PHP_EOL;
    $s .= '<td class="border">'.$desc.'</td>'.PHP_EOL;
    $s .= '<td class="border text-right">'.$cost.'</td>'.PHP_EOL;
    $s .= '<td class="border border-r-0 text-right">'.$weight.'</td>'.PHP_EOL;
    $s .= '</tr>'.PHP_EOL;

    return $s;
}

function tableRowTotal($title, $cost, $weight, $complete = false)
{
    $s = '<tr>'.PHP_EOL;
    $s .= '<td colspan="2" class="border-t border-r text-right font-bold">Total '.$title.'</td>'.PHP_EOL;
    $s .= '<td class="border-t border-l border-r text-right">'.$cost.'</td>'.PHP_EOL;
    $s .= '<td class="border-t border-l text-right">'.$weight.'</td>'.PHP_EOL;
    $s .= '</tr>'.PHP_EOL;

    return $s;
}

function tableRowFinal($title, $footnote, $cost, $weight)
{
    $s = '<tr>'.PHP_EOL;
    $s .= '<td colspan="2" class="border-t border-r"><span class="text-sm text-gray-700 float-left">'.$footnote.'</span> <span class="font-bold float-right">Total '.$title.'</span></td>'.PHP_EOL;
    $s .= '<td class="border-t border-l border-r text-right">'.$cost.'</td>'.PHP_EOL;
    $s .= '<td class="border-t border-l text-right">'.$weight.'</td>'.PHP_EOL;
    $s .= '</tr>'.PHP_EOL;

    return $s;
}

function tableRowSpacer()
{
    $s = '<tr>'.PHP_EOL;
    $s .= '<td colspan="4" class="border-0">&nbsp;</td>'.PHP_EOL;
    $s .= '</tr>'.PHP_EOL;

    return $s;
}

include './data-2020.php';

echo generate($version, $completeTitle, $footnote, $basepackTitle, $carriedTitle, $carriedData, $backpackTitle, $backpackData, $shelterTitle, $shelterData, $sleepingTitle, $sleepingData, $clothingTitle, $clothingData, $gearTitle, $gearData, $consumablesTitle, $consumablesData);
?>
