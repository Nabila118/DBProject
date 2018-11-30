import React from 'react';
import ReactDOM from 'react-dom';

import JqxGrid from '../../../jqwidgets-react/react_jqxgrid.js';

class App extends React.Component {
    render() {
        let source =
            {
                datatype: 'xml',
                datafields: [
                    { name: 'ShippedDate', map: 'm\\:properties>d\\:ShippedDate', type: 'date' },
                    { name: 'Freight', map: 'm\\:properties>d\\:Freight', type: 'float' },
                    { name: 'ShipName', map: 'm\\:properties>d\\:ShipName', type: 'string' },
                    { name: 'ShipAddress', map: 'm\\:properties>d\\:ShipAddress', type: 'string' },
                    { name: 'ShipCity', map: 'm\\:properties>d\\:ShipCity', type: 'string' },
                    { name: 'ShipCountry', map: 'm\\:properties>d\\:ShipCountry', type: 'string' }
                ],
                root: 'entry',
                record: 'content',
                id: 'm\\:properties>d\\:OrderID',
                url: '../sampledata/orders.xml',
                pager: (pagenum, pagesize, oldpagenum) => {
                    // callback called when a page or page size is changed.
                },
                updaterow: (rowid, rowdata, result) => {
                    // synchronize with the server - send update command
                    // call result with parameter true if the synchronization with the server is successful 
                    // and with parameter false if the synchronization failder.
                    result(true);
                }
            };

        let dataAdapter = new $.jqx.dataAdapter(source);

        let columns =
            [
                {
                    text: 'Ship City', datafield: 'ShipCity', width: 150, columntype: 'combobox',
                    createeditor: (row, column, editor) => {
                        // assign a new data source to the combobox.
                        let list = ['Stuttgart', 'Rio de Janeiro', 'Strasbourg'];
                        editor.jqxComboBox({ autoDropDownHeight: true, source: list, promptText: 'Please Choose:' });
                    },
                    // update the editor's value before saving it.
                    cellvaluechanging: (row, column, columntype, oldvalue, newvalue) => {
                        // return the old value, if the new value is empty.
                        if (newvalue == '') return oldvalue;
                    }
                },
                {
                    text: 'Ship Country', datafield: 'ShipCountry', width: 150, columntype: 'dropdownlist',
                    createeditor: (row, column, editor) => {
                        // assign a new data source to the dropdownlist.
                        let list = ['Germany', 'Brazil', 'France'];
                        editor.jqxDropDownList({ autoDropDownHeight: true, source: list });
                    },
                    // update the editor's value before saving it.
                    cellvaluechanging: (row, column, columntype, oldvalue, newvalue) => {
                        // return the old value, if the new value is empty.
                        if (newvalue == '') return oldvalue;
                    }
                },
                { text: 'Ship Name', datafield: 'ShipName', columntype: 'combobox' }
            ];

        return (
            <div style={{ fontSize: 13, fontFamily: 'Verdana', float: 'left' }}>
                <JqxGrid
                    width={850} source={dataAdapter} pageable={true}
                    autoheight={true} editable={true} columns={columns}
                    selectionmode={'singlecell'}
                />
            </div>
        )
    }
}

ReactDOM.render(<App />, document.getElementById('app'));
