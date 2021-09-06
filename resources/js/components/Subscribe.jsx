import React, { Component } from 'react';
import axios from "axios";

class Subscribe extends Component {

    constructor(props) {
        super(props);

        this.state = {
            name: '',
            email: '',
            errors: [],
            message: ''
        }

        this.getName = this.getName.bind(this);
        this.getEmail = this.getEmail.bind(this);
        
        this.handleSubmit = this.handleSubmit.bind(this);

    }
    handleValidation() {
        let formIsValid = true;
        let errors = [];
        if (!this.state.name) {
            formIsValid = false;
            errors.push('Name Cannot be empty');
        }
        if (typeof this.state.email !== "undefined") {
            let lastAtPos = this.state.email.lastIndexOf('@');
            let lastDotPos = this.state.email.lastIndexOf('.');

            if (!(lastAtPos < lastDotPos && lastAtPos > 0 && this.state.email.indexOf('@@') == -1 && lastDotPos > 2 && (this.state.email.length - lastDotPos) > 2)) {
                formIsValid = false;
                errors.push('Email is not valid');
            }
        }
        this.setState({ errors: errors ,message:''});
        return formIsValid;
    }
    getName(event) {
        this.setState({ name: event.target.value })
    }
    getEmail(event) {
        this.setState({ email: event.target.value })
    }

    handleSubmit() {
        var valid = this.handleValidation();
        if (valid) {
            const packets = {
                name: this.state.name,
                email: this.state.email,
            };
            axios.post('/api/subscribe_newsletter', packets)
                .then(response =>{
                    this.setState({ name: '', email: '', message: response.data.message,errors:{} })  
                })
                .catch(error => {
                    console.log("ERROR:: ",error.response.data);
                    let errs=[];
                    if(!error.response.data.status){
        
                        for (let key in error.response.data.errors) {
                            errs.push(error.response.data.errors[key]);
                        }
                    }
                    this.setState({errors:errs,message:''});
                });
        }
        return false;
    }

    render() {
       // console.log(this.state);
        return (
            <div>


                <div className="container">

                    <div className="login-content">

                        <form>
                            <h2 className="title">Subscribe</h2>
                            <div className="notices">
                                {this.state.errors.length > 0 &&

                                    this.state.errors.map((error, i) => { 
                                       return <p key={i} className="error">{error}</p>
                                    })
                                }
                                {this.state.message.length > 0 &&
                                    <p className="success">{this.state.message}</p>
                                }
                            </div>
                            <div className="one">
                                <input type="text" placeholder="Name" onChange={this.getName} className="input" value={this.state.name} />
                            </div>

                            <div className="one">
                                <input type="email" placeholder="Email" onChange={this.getEmail} className="input" value={this.state.email} />
                            </div>

                            <button type="button" className="btn" onClick={this.handleSubmit}>Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        );
    }
}
export default Subscribe;