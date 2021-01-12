import logo from './logo.svg';
import './App.css';

import React from 'react';
import axios from 'axios';

class App extends React.Component {

    handleChange = (event) => {
        const target = event.target;
        const name = target.name;
        const value = target.value;

        this.setState({
            [name]: value
        });
    };

    componentDidMount = () => {
        this.getInstruments();
    }

    getInstruments = () => {
        axios.get('/api/instruments')            
        .then((response) => {
            const data = response.data;
            this.setState({ Instruments: data });
            console.log('Data has been received.');
         })
         .catch(() => {
            console.log('Error retrieving data.');
         });;
    }

    state = {
        firstName: '',
        lastName: '',
        email: '',
        comments: '',
        Instrument: '',
        Instruments: []
    };

    submit = (event) => {
        event.preventDefault();

        const payload = {
            firstName: this.state.firstName,
            lastName: this.state.lastName,
            email: this.state.email,
            comments: this.state.comments,
            Instrument: this.state.Instrument                           
        };

        axios({
            url: '/api/save',
            method: 'POST',
            data: payload
        })
         .then(() => {
            console.log('Signup info has been sent to the server');
            this.resetSignUpForm();
         })
         .catch(() => {
            console.log('Internal server error');
         });;
    };

    resetSignUpForm = () => {
        this.setState({
            firstName: '',
            lastName: '',
            comments: '',
            email: ''
        });
    };

    displayInstruments = (Instruments) => {
        if (!Instruments.length) return null;

        return Instruments.map((Instrument, index) => (
            <option value={Instrument.instrumentID}>{Instrument.instrumentName}</option>

        ));
    };


    render() {



        console.log('State: ', this.state);
        //JSX
        return(

<div className="App">
      <head>        
        <title>Valeport Downloads</title>

        <link rel="stylesheet" id="wp-block-library-css" href="https://www.valeport.co.uk/wp/wp-includes/css/dist/block-library/style.min.css?ver=5.5.3" type="text/css" media="all"></link>
        <link rel="stylesheet" id="wp-block-library-theme-css" href="https://www.valeport.co.uk/wp/wp-includes/css/dist/block-library/theme.min.css?ver=5.5.3" type="text/css" media="all"></link>
        <link data-minify="1" rel="stylesheet" id="fonts-css" href="https://www.valeport.co.uk/content/cache/min/1/jvm0roe-47287664a5cc4737ab49a36b129f379b.css" type="text/css" media="all"></link>
        <link rel="stylesheet" id="app-css" href="https://www.valeport.co.uk/content/themes/valeport/assets/dist/css/downloads.css" type="text/css" media="all"></link>
        <link rel="stylesheet" id="fonts-css" href="https://use.typekit.net/jvm0roe.css?ver=5.3.3" type="text/css" media="all"></link>
        <link rel="icon" href="https://www.valeport.co.uk/content/uploads/2020/04/cropped-vale-fav-150x150.png" sizes="32x32"></link>		
        <link rel="icon" href="https://www.valeport.co.uk/content/uploads/2020/04/cropped-vale-fav-150x150.png" sizes="32x32"></link>
        <link rel="icon" href="https://www.valeport.co.uk/content/uploads/2020/04/cropped-vale-fav-300x300.png" sizes="192x192"></link>
        <script src="./valeportDownload.js"></script>      
      </head>
      
      <main className="App-main">      
        <header className="App-header">
            <nav>

            </nav>
            <a href="https://www.valeport.co.uk" className="logo">
              <img src={logo} className="App-logo" alt="logo" />
            </a>
        </header>
      </main>

      <body className="App-body">

        <section className="layout">
            <div className="row">
                <div className="column one-whole center">
                    <h1 className="">
                        Valeport Downloads
                    </h1>
                </div>
            </div>
        </section>

        <section className="layout downloads">
            <div className="row">
                <div className="column one-whole">
                    <p>Select the instrument you want to search for:</p>
                      

                    <select className="simple-select" name="Instrument" id="Instrument" value={this.state.instrument} onChange={this.handleChange}>                        
                        {this.displayInstruments(this.state.Instruments)}    
                    </select>

                    
                    <p id="instDownloads"></p>
                    <p id="previousVersions"></p>
                </div>
            </div>
        </section>
      </body>

        <footer className="footer">
    
        <section className="section">
            <div className="row">
                <div className="column one-whole center">
                    <a href="https://www.valeport.co.uk" className="logo">
                        <svg className=""></svg>
                    </a>
                </div>
            </div>
            <div className="row">

                <div className="column one-half l-one-whole">
                    <h3 className="footer-title">Sign up for updates</h3>
                    
                    <form className="form signup-form">   
                        <label className="label" htmlFor="signup-first-name">Name</label>

                        <div className="form-row columns">
                            <div className="input">
                                <input
                                    type="text"
                                    name="firstName"
                                    id="signup-first-name"
                                    className="input-field"
                                    placeholder="First name*"
                                    required=""
                                    value={this.state.firstName}
                                    onChange={this.handleChange} 
                                />
                            </div>                            
                            <div className="input">
                                <input
                                    type="text"
                                    name="lastName"
                                    className="input-field"
                                    placeholder="Last name"
                                    value={this.state.lastName}
                                    onChange={this.handleChange} 
                                />
                            </div>
                        </div>   

                        <label className="label" htmlFor="signup-email">Email</label>
                        <div className="form-row">
                            <div className="input">             
                                <input
                                    id="signup-email"
                                    type="email"
                                    name="email"
                                    aria-label="Email address"
                                    className="input-field"
                                    placeholder="Enter a valid email address*"
                                    required=""
                                    value={this.state.email}
                                    onChange={this.handleChange} 
                                />
                            </div>
                        </div>

                        <input type="hidden" value="website-footer" name="signup-location"></input>

                        <div>
                            <label className="label" htmlFor="signup-email">Comments</label>                            
                            <div className="form-input">
                                <div className="input">
                                    <textarea
                                        placeholder=""
                                        name="comments"
                                        cols="7"
                                        rows="3"
                                        value={this.state.comments}
                                        onChange={this.handleChange} 
                                    ></textarea>
                                </div>
                            </div>  
                        </div>

                        <div className="form-row">
                            <button type="submit" className="button" onClick={this.submit}>
                                Sign me up!
                                <svg className="icon"></svg>
                            </button>
                        </div>
                        
                    </form>
                </div>

                <div className="column one-third push-sixth xl-one-half l-one-whole">
                    <h3 className="footer-title">Contact</h3>
                    
                    <address>Valeport Ltd, St. Peter's Quay, Totnes, Devon, TQ9 5EW United Kingdom</address>

                    <p>
                        <a href="tel:+441803869292">+44(0)1803 869292</a>
                        <br></br>
                        <a href="mailto:sales@valeport.co.uk">sales@valeport.co.uk</a>
                    </p>
                         
                </div>
            </div>
        </section>

        <section className="section bg--grey">
            <div className="row">
                <div className="column one-whole">
                    <nav>
                        <ul id="menu-footer-menu" className="footer-menu"><li id="menu-item-3040" className="menu-item menu-item-type-post_type menu-item-object-page menu-item-3040"><a href="https://www.valeport.co.uk/website-terms-conditions/">Website Terms &amp; Conditions</a></li>
                        <li id="menu-item-3041" className="menu-item menu-item-type-post_type menu-item-object-page menu-item-privacy-policy menu-item-3041"><a href="https://www.valeport.co.uk/privacy-policy/">Privacy Policy</a></li>
                        <li id="menu-item-3042" className="menu-item menu-item-type-post_type menu-item-object-page menu-item-3042"><a href="https://www.valeport.co.uk/cookie-policy/">Cookie Policy</a></li>
                        <li id="menu-item-3057" className="ot-sdk-show-settings menu-item menu-item-type-post_type menu-item-object-page menu-item-3057"><a href="https://www.valeport.co.uk/cookie-policy/">Cookies Settings</a></li>
                        <li id="menu-item-3033" className="menu-item menu-item-type-post_type menu-item-object-page menu-item-3033"><a href="https://www.valeport.co.uk/supplier-requirements/">Supplier Requirements</a></li>
                        <li id="menu-item-263" className="menu-item menu-item-type-post_type menu-item-object-page menu-item-263"><a href="https://www.valeport.co.uk/contact/">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
    
    </footer>

</div>


        );
    }
}

export default App;
