import React, { Component } from 'react'
import request from "adios/Request";
import Table, { TableProps, TableState } from 'adios/Table';
import Form, { FormProps } from 'adios/Form';
import FormMail from './FormMail';
import { ProgressBar } from 'primereact/progressbar';
import ModalForm from "adios/ModalForm";

interface ListFolderProps extends TableProps {
  folder?: string,
}
interface ListFolderState extends TableState {
}

export default class ListFolder extends Table<ListFolderProps, ListFolderState> {
  static defaultProps = {
    ...Table.defaultProps,
    formUseModalSimple: true,
    orderBy: {
      field: "id",
      direction: "desc"
    },
    model: 'HubletoApp/Community/Mail/Models/Mail',
  }

  props: ListFolderProps;
  state: ListFolderState;

  translationContext: string = 'HubletoApp\\Community\\Mail\\Loader::Components\\ListFolder';

  constructor(props: ListFolderProps) {
    super(props);
    this.state = {
      ...this.getStateFromProps(props),
    };
  }

  getEndpointParams() {
    return {
      ...super.getEndpointParams(),
      folder: this.props.folder
    }
  }

  getFormModalProps(): any {
    let params = super.getFormModalProps();
    params.type = 'right';
    return params;
  }

  rowClassName(rowData: any): string {
    if (this.props.folder == 'inbox') {
      return rowData.read ? '' : 'bg-yellow-50 text-yellow-800';
    } else {
      return '';
    }
  }

  renderActionsColumn(data: any, options: any) {
    const R = this.findRecordById(data.id);
    if (this.props.folder == 'inbox') {
      if (R.read) {
        return <button
          className="btn btn-small btn-transparent"
          onClick={(e) => {
            e.preventDefault();
            request.get( "messages/api/mark-as-unread", { idMail: data.id }, (response: any) => { this.loadData(); } )
          }}
        >
          <span className="icon"><i className="fas fa-eye-slash"></i></span>
          <span className="text">Mark as unread</span>
        </button>
      } else {
        return <button
          className="btn btn-small btn-transparent"
          onClick={(e) => {
            e.preventDefault();
            request.get( "messages/api/mark-as-read", { idMail: data.id }, (response: any) => { this.loadData(); } )
          }}
        >
          <span className="icon"><i className="fas fa-eye"></i></span>
          <span className="text">Mark as read</span>
        </button>
      }
    }
  }

  renderForm(): JSX.Element {
    let formProps: FormProps = this.getFormProps();
    return <FormMail {...formProps}/>;
  }

}