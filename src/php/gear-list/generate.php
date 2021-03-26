<?php
setlocale(LC_MONETARY, 'en_US');

include './data-2021.php';

$outputPath = '../../../content/ultralight-backpacking-gear-list/';

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

function tableHeader($title)
{
  $s = '<div class="table-responsive">'.PHP_EOL;
  $s .= '<table class="table-gearlist">'.PHP_EOL;
  $s .= '<thead>'.PHP_EOL;
  $s .= '<tr class="bg-gray-200">'.PHP_EOL;
  $s .= '<th>'.$title.'</th>'.PHP_EOL;
  $s .= '<th class="border-l">Item</th>'.PHP_EOL;
  $s .= '<th class="border-l text-right">Cost</th>'.PHP_EOL;
  $s .= '<th class="border-l text-right">Weight</th>'.PHP_EOL;
  $s .= '</tr>'.PHP_EOL;
  $s .= '</thead>'.PHP_EOL;
  $s .= '<tbody>'.PHP_EOL;

  return $s;
}

function tableRowItem($item, $desc, $cost, $weight)
{
  if ($item == "Alternate" || $item == "Optional")
  {
    $s = '<tr>'.PHP_EOL;
    $s .= '<td class="border-t text-right text-gray-500">'.$item.'</td>'.PHP_EOL;
    $s .= '<td class="border-t border-l">'.$desc.'</td>'.PHP_EOL;
    $s .= '<td class="border-t border-l text-right text-gray-500">'.$cost.'</td>'.PHP_EOL;
    $s .= '<td class="border-t border-l text-right text-gray-500">'.$weight.'</td>'.PHP_EOL;
    $s .= '</tr>'.PHP_EOL;
  }
  else
  {
    $s = '<tr>'.PHP_EOL;
    $s .= '<td class="border-t">'.$item.'</td>'.PHP_EOL;
    $s .= '<td class="border-t border-l">'.$desc.'</td>'.PHP_EOL;
    $s .= '<td class="border-t border-l text-right">'.$cost.'</td>'.PHP_EOL;
    $s .= '<td class="border-t border-l text-right">'.$weight.'</td>'.PHP_EOL;
    $s .= '</tr>'.PHP_EOL;
  }

  return $s;
}

function tableTotal($title, $cost, $weight)
{
  $s = '</tbody>'.PHP_EOL;
  $s .= '<tfoot>'.PHP_EOL;
  $s .= '<tr>'.PHP_EOL;
  $s .= '<td colspan="2" class="border-t text-right font-bold">Total '.$title.'</td>'.PHP_EOL;
  $s .= '<td class="border-t border-l text-right">'.$cost.'</td>'.PHP_EOL;
  $s .= '<td class="border-t border-l text-right">'.$weight.'</td>'.PHP_EOL;
  $s .= '</tr>'.PHP_EOL;
  $s .= '</tfoot>'.PHP_EOL;
  $s .= '</table>'.PHP_EOL;
  $s .= '</div>'.PHP_EOL;

  return $s;
}

function tableGrandTotalRow($title, $cost, $weight)
{
  $s = '<tr>'.PHP_EOL;
  $s .= '<td class="border-t text-right font-bold">Total '.$title.'</td>'.PHP_EOL;
  $s .= '<td class="border-t border-l text-right">'.$cost.'</td>'.PHP_EOL;
  $s .= '<td class="border-t border-l text-right">'.$weight.'</td>'.PHP_EOL;
  $s .= '</tr>'.PHP_EOL;

  return $s;
}

function tableGrandTotal($title, $subtotal, $grandtotal)
{
  $s = '<div class="table-responsive">'.PHP_EOL;
  $s .= '<table class="table-gearlist">'.PHP_EOL;
  $s .= '<thead>'.PHP_EOL;
  $s .= '<tr class="bg-gray-200">'.PHP_EOL;
  $s .= '<th colspan="3">'.$title.'</th>'.PHP_EOL;
  $s .= '</tr>'.PHP_EOL;
  $s .= '</thead>'.PHP_EOL;
  $s .= '<tfoot>'.PHP_EOL;
  $s .= $subtotal;
  $s .= $grandtotal;
  $s .= '</tfoot>'.PHP_EOL;
  $s .= '</table>'.PHP_EOL;
  $s .= '</div>'.PHP_EOL;

  return $s;
}

/**
 * **************************************************
 * GENERATE
 * **************************************************
 */

/**
 * **************************************************
 * Carried
 * **************************************************
 */
$s = '';
$s .= tableHeader($carriedTitle);

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

    if ($carriedData[$i][0] != "Alternate" && $carriedData[$i][0] != "Optional") {
      $carriedCost += $carriedData[$i][2]; // Total Cost
      $carriedWeight += $carriedData[$i][3]; // Total Weight
    }
}

$s .= tableTotal(
    $carriedTitle,
    toMoneyFormat($carriedCost),
    toWeightFormat($carriedWeight)
);

file_put_contents($outputPath.'01-worn-carried-data.html', $s);

/**
 * **************************************************
 * Base Pack: Backpack
 * **************************************************
 */
$s = '';
$s .= tableHeader($backpackTitle);

$backpackCost = 0;
$backpackWeight = 0;
$d = sizeof($backpackData);
for ($i=0; $i < $d ; $i++)
{
    $s .= tableRowItem(
        $backpackData[$i][0], // Item
        $backpackData[$i][1], // Desc
        toMoneyFormat($backpackData[$i][2]), // Cost
        toWeightFormat($backpackData[$i][3]) // Weight
    );

    if ($backpackData[$i][0] != "Alternate" && $backpackData[$i][0] != "Optional") {
      $backpackCost += $backpackData[$i][2]; // Total Cost
      $backpackWeight += $backpackData[$i][3]; // Total Weight
    }
}

$s .= tableTotal(
    $backpackTitle,
    toMoneyFormat($backpackCost),
    toWeightFormat($backpackWeight)
);

file_put_contents($outputPath.'02-basepack-backpack-data.html', $s);

/**
 * **************************************************
 * Base Pack: Shelter
 * **************************************************
 */
$s = '';
$s .= tableHeader($shelterTitle);

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

    if ($shelterData[$i][0] != "Alternate" && $shelterData[$i][0] != "Optional") {
      $shelterCost += $shelterData[$i][2]; // Total Cost
      $shelterWeight += $shelterData[$i][3]; // Total Weight
    }
}

$s .= tableTotal(
    $shelterTitle,
    toMoneyFormat($shelterCost),
    toWeightFormat($shelterWeight)
);

file_put_contents($outputPath.'03-basepack-shelter-data.html', $s);

/**
 * **************************************************
 * Base Pack: Sleeping
 * **************************************************
 */
$s = '';
$s .= tableHeader($sleepingTitle);

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

    if ($sleepingData[$i][0] != "Alternate" && $sleepingData[$i][0] != "Optional") {
      $sleepingCost += $sleepingData[$i][2]; // Total Cost
      $sleepingWeight += $sleepingData[$i][3]; // Total Weight
    }
}

$s .= tableTotal(
    $sleepingTitle,
    toMoneyFormat($sleepingCost),
    toWeightFormat($sleepingWeight)
);

file_put_contents($outputPath.'04-basepack-sleeping-data.html', $s);

/**
 * **************************************************
 * Base Pack: Clothing
 * **************************************************
 */
$s = '';
$s .= tableHeader($clothingTitle);

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

    if ($clothingData[$i][0] != "Alternate" && $clothingData[$i][0] != "Optional") {
      $clothingCost += $clothingData[$i][2]; // Total Cost
      $clothingWeight += $clothingData[$i][3]; // Total Weight
    }
}

$s .= tableTotal(
    $clothingTitle,
    toMoneyFormat($clothingCost),
    toWeightFormat($clothingWeight)
);

file_put_contents($outputPath.'05-basepack-clothing-data.html', $s);

/**
 * **************************************************
 * Base Pack: Gear
 * **************************************************
 */
$s = '';
$s .= tableHeader($gearTitle);

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

    if ($gearData[$i][0] != "Alternate" && $gearData[$i][0] != "Optional") {
      $gearCost += $gearData[$i][2]; // Total Cost
      $gearWeight += $gearData[$i][3]; // Total Weight
    }
}

$s .= tableTotal(
    $gearTitle,
    toMoneyFormat($gearCost),
    toWeightFormat($gearWeight)
);

file_put_contents($outputPath.'06-basepack-gear-data.html', $s);

/**
 * **************************************************
 * Consumables
 * **************************************************
 */
$s = '';
$s .= tableHeader($consumablesTitle);

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

    if ($consumablesData[$i][0] != "Alternate" && $consumablesData[$i][0] != "Optional") {
      $consumablesCost += $consumablesData[$i][2]; // Total Cost
      $consumablesWeight += $consumablesData[$i][3]; // Total Weight
    }
}

$s .= tableTotal(
    $consumablesTitle,
    toMoneyFormat($consumablesCost),
    toWeightFormat($consumablesWeight)
);

file_put_contents($outputPath.'07-consumables-data.html', $s);

 /**
 * **************************************************
 * Grand Total
 * **************************************************
 */
$basepackTotal = tableGrandTotalRow(
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

$grandTotal = tableGrandTotalRow(
    $completeTitle,
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

$s = '';
$s .= tableGrandTotal($grandTotalTitle, $basepackTotal, $grandTotal);

file_put_contents($outputPath.'08-totals-data.html', $s);
?>
