<?php
$pageTitle = "ag-Grid Accessing Data";
$pageDescription = "Shows how to access the data inside ag-Grid.";
$pageKeyboards = "ag-Grid Accessing Data";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<?php include './accessingDataProperties.php' ?>

<div>

    <h2 id="insert-remove">Accessing Data</h2>

    <p>
        Each time you pass data to the grid, the grid wraps each data item
        with a <a href="../javascript-grid-row-node/">rowNode</a> object.
        For example if your data has 20 rows, then the grid creates 20 rowNode
        objects, each rowNode wrapping one item of your data.
    </p>

    <p>
        It is sometimes handy to access these rowNodes. One example where it is handy
        is if you want to select a row, you can call <code>rowNode.setSelected(true)</code>
        to select it.
        This section details the different ways a rowNode can be accessed.
    </p>

    <p>
        The following methods are provided for accessing the individual rowNodes.
        A deeper explanation of these methods, along with examples, are provided
        further down.
    </p>

    <h3>Accessing Row Node API Methods</h3>
    <table class="table">
        <?php printPropertiesRows($getRowNodeApi) ?>
    </table>

    <h2 id="access-node-by-id">Accessing RowNode by ID</h2>

    <p>
        The easiest way to get a rowNode is by it's ID.
        The ID is either provided by you using the grid callback <code>getRowNodeId()</code>,
        or generated by the grid using an internal sequence.
    </p>

    <snippet>
// callback tells the grid to use the 'id' attribute for id's
// id's should always be strings
gridOptions.getRowNodeId = function(data) {
    return data.id;
};

// get the row node with ID 55
var rowNode = api.getRowNode('55');

// do something with the row, eg select it
rowNode.setSelected(true);</snippet>

    <p>
        Accessing the rowNode by ID is available in the <a href="../javascript-grid-in-memory/">In Memory
        Row Model</a> only.
    </p>

    <h2 id="for-each-node">Iterating Rows</h2>

    <p>
        Sometimes you may want to iterate through all the rowNodes in the grid.
        This can be done using the grid's iteration APIs. The iteration API's
        go through every rowNode, regardless of whether the rowNode is displayed
        or not. For example if grouping and the group is closed, the group's children
        are not displayed by the grid, however the children are included in the
        iteration 'for-each' methods.
    </p>

    <snippet>
// iterate through every node in the grid
api.forEachNode( function(rowNode, index) {
    console.log('node ' + rowNode.data.athlete + ' is in the grid');
});

// iterate only nodes that pass the filter
api.forEachNodeAfterFilter( function(rowNode, index) {
    console.log('node ' + rowNode.data.athlete + ' passes the filter');
});

// iterate only nodes that pass the filter and ordered by the sort order
api.forEachNodeAfterFilterAndSort( function(rowNode, index) {
    console.log('node ' + rowNode.data.athlete + ' passes the filter and is in this order');
});

// iterate through every leaf node in the grid
api.forEachLeafNode( function(rowNode, index) {
    console.log('node ' + rowNode.data.athlete + ' is not a group!');
});</snippet>

    <p>
        All of the methods above work with the <a href="../javascript-grid-in-memory/">In Memory
        Row Model</a>. For all the other row models (<a href="../javascript-grid-viewport/">Viewport</a>,
        <a href="../javascript-grid-infinite-scrolling/">Infinite</a> and
        <a href="../javascript-grid-enterprise-model/">Enterprise</a>) the only method that is supported
        is <code>api.forEachNode()</code> and that will return back row nodes that are loaded into
        browser memory only (as each of these row models use a data source to lazy load rows).
    </p>

    <h2 id="example-api">Example Using For-Each Methods</h2>

    <p>
        The example below shows the different for-Each API methods as follows:
    </p>

    <ul>
        <li><b>For-Each Node</b>: Prints out every row in the grid. It ignores filtering and sorting.</li>
        <li><b>For-Each Node After Filter</b>: Prints out every row in the grid, except those filtered out.</li>
        <li><b>For-Each Node After Filter and Sort</b>: Prints our every row in the grid, except those filtered,
            and is the same order they appear in the screen if sorting is applied.</li>
        <li><b>For-Each Leaf Node</b>: Prints out every row in the grid except group rows.</li>
    </ul>

    <p>
        In the example, try applying some sorts and filters, and see how this impacts the different operations.
    </p>

    <?= example('Using For-Each', 'using-for-each', 'generated', array("enterprise" => 1)) ?>

    <h2 id="for-each-node">Accessing Displayed Rows</h2>

    <p>
        Displayed rows are rows that the grid tries to render. For example, if you have a group
        that is closed, the children of that group will not appear in the displayed rows.
        The grid renders the displayed rows onto the screen.
    </p>

    <p>
        The displayed rows have indexes. For example, if the grid is rendering 20 rows, then will have
        indexes 0 to 19.
    </p>

    <p>
        You can look up the rows by index. This is dependent on anything that changes the index.
        For example, if you apply a sort or filter, then the rows and corresponding indexes will change.
    </p>

    <p>
        Accessing displayed rows works with all row models.
    </p>

    <h2 id="example-api">Accessing Displayed Rows Example</h2>

    <p>
        The example below demonstrates the following:
    </p>

    <ul>
        <li><b>Get Displayed Row 0:</b> Returns back the first row in the grid. This is not impacted
        by what page you are one, eg if you navigate to the second page, this method will still
        return the first row on the first page. If you sort, the first row will be changed.</li>
        <li><b>Get Displayed Row Count:</b> Returns back the total number of rows across all pages. If
        you filter, this number will change accordingly.</li>
        <li><b>Print All Displayed Rows:</b> Demonstrates looping through all rows on the screen across
            all pages.</li>
        <li><b>Print Page Displayed Rows:</b> Demonstrates looping through all rows on the screen on
            one page.</li>
    </ul>

    <?= example('Get Displayed Row', 'get-displayed-row', 'generated') ?>
</div>

<?php include '../documentation-main/documentation_footer.php';?>
