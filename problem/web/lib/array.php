<?php

// Copyright 2022 Nanoninja. All rights reserved.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

/**
 * @see https://www.php.net/manual/en/function.array-intersect-key.php
 * @see https://www.php.net/manual/fr/function.array-diff.php
 * 
 * @param array $data
 * @param array $config
 *  [
 *      'groupBy' => 'primary_id',
 *      'alias' => 'column_values_name',
 *      'columns' => [
 *          'columnB',
 *          'columnA',
 *      ],
 *  ];
 * @return array
 */
function array_aggregate(array $data, array $config)
{
    // Initialization of the final data table.
    $result = [];

    // Initialization of the final data table.
    // array[
    //    'columnA' => null,
    //    'columnB' => null,
    // ]
    $columns = array_fill_keys($config['columns'], null);

    foreach ($data as $row) {
        $item = $row;

        // Get child of row with column name provides.
        $child = array_intersect_key($row, $columns);

        // Remove null items.
        $child = array_diff($child, $columns);

        if (empty($child)) {
            // Append empty child.
            $children[$row[$config['groupBy']]] = $child;
        } else {
            // Append child?
            $children[$row[$config['groupBy']]][] = $child;
        }

        // Removal of columns that were added as children.
        $item = array_diff_key($item, $child, $columns);

        // Append children.
        $item[$config['alias']] = $children[$row[$config['groupBy']]];

        // Append item to result.
        $result[$row[$config['groupBy']]] = $item;
    }

    return $result;
}