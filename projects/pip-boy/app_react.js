
	class OperatingSystem {
	    constructor(isactive = false) {
	        this.displayName = "Operating System";
	        this.dataDescription = this.getDescription();
	        this.active = isactive;
	    }
	    generateData() {
	        return new Promise((resolve, reject) => {
                resolve(fingerprint_os());
	        });
	    }
	    getDescription() {
	        return "The Operating System running in your hardware.";
	    }
	}

	class Browser {
	    constructor(isactive = false) {
	        this.displayName = "Browser";
	        this.dataDescription = this.getDescription();
	        this.active = isactive;
	    }
	    generateData() {
	        return new Promise((resolve, reject) => {
                resolve(fingerprint_browser());
	        });
	    }
	    getDescription() {
	        return "The name and version of your web browser.";
	    }
	}

	class Battery {
	    constructor(isactive = false) {
	        this.displayName = "Battery";
	        this.dataDescription = this.getDescription();
	        this.active = isactive;
	    }
	    generateData() {
	        return new Promise((resolve, reject) => {
	            navigator.getBattery().then(batterydata => {
	                resolve(`${batterydata.level * 100} %`);
	            });
	        });
	    }
	    getDescription() {
	        return "The navigator.getBattery method returns a battery promise that is resolved in a BatteryManager interface which you can use to interact with the Battery Status API.";
	    }
	}

	class Language {
	    constructor(isactive = false) {
	        this.displayName = "Language";
	        this.dataDescription = this.getDescription();
	        this.active = isactive;
	    }
	    generateData() {
	        return new Promise((resolve, reject) => {
	            resolve(navigator.language);
	        });
	    }
	    getDescription() {
	        return 'The language property returns the language version of the browser. Examples of valid language codes are: "en", "en-US", "de", "fr", etc.';
	    }
	}

	class Coordinates {
	    constructor(isactive = false) {
	        this.displayName = "Coordinates";
	        this.dataDescription = this.getDescription();
	        this.active = isactive;
	    }
	    generateData() {
	        return new Promise((resolve, reject) => {
	            if (navigator.geolocation) {
	                navigator.geolocation.getCurrentPosition(
	                	position => { resolve(`lat: ${position.coords.latitude} \n lon: ${position.coords.longitude}`); },
	                	positionError => { resolve(positionError.message); },
                	);
	            } else {
	                resolve("Geolocation not disabled.");
	            }
	        });
	    }
	    getDescription() {
	        return "The Geolocation.getCurrentPosition() method is used to get the current position of the device.";
	    }
	}

	class TimeZone {
	    constructor(isactive = false) {
	        this.displayName = "Time Zone";
	        this.dataDescription = this.getDescription();
	        this.active = isactive;
	    }

	    generateData() {
	        return new Promise((resolve, reject) => {
	            resolve(new Date().toString().match(/([A-Z]+[\+-][0-9]+)/)[1]);
	        });
	    }

	    getDescription() {
	        return "The Date object is a datatype built into the JavaScript language. Date objects are created with the new Date()";
	    }
	}

	let Collection = {
	    categories: [
	        {
	            name: "Position",
	            active: true,
	            items: [new TimeZone(true), new Coordinates()]
	        },
	        {
	            name: "Device",
	            active: false,
	            items: [new Language(true), new Battery(), new Browser(), new OperatingSystem()]
	        }
        ]
	};


	class Page extends React.Component {
	    constructor() {
	        super();
	        this.state = Collection;
	    }

	    setFooterActive(i) {
	        this.state.categories.map(c => {
	            c.active = false;
	        });
	        this.state.categories[i].active = true;

	        this.setState({categories: this.state.categories});
	    }

	    setItemActive(i) {
	        let activecategoryindex = this.state.categories.map(e => {
	            return e.active;
	        }).indexOf(true);

	        this.state.categories[activecategoryindex].items.map(c => {
	            c.active = false;
	        });
	        this.state.categories[activecategoryindex].items[i].active = true;

	        this.setState({categories: this.state.categories});
	    }

	    render() {
	        let activecategory = this.state.categories.filter(category => {
	            return category.active;
	        })[0];
	        return (
	            React.createElement("div", {className: "container"},
	                React.createElement(Header, {activeCategory: activecategory}),
	                React.createElement(MainView, {
	                    setActive: this.setItemActive.bind(this),
	                    activeCategory: activecategory
	                }),
	                React.createElement(Footer, {
	                    setActive: this.setFooterActive.bind(this),
	                    categories: this.state.categories
	                })
                )
            );
	    }
	}

	class Footer extends React.Component {
	    render() {
	        return (
	            React.createElement("div", {className: "footer"},
	                React.createElement("div", {className: "container-bottom"},
	                    React.createElement("div", {className: "separator left-side"}),
	                    this.props.categories.map((category, index) => {
	                        let setActive = this.props.setActive.bind(this, index);
	                        return (
	                            React.createElement("div", {
	                                    onClick: setActive,
	                                    className:
	                                        category.active ? "active menu-option" : "menu-option"
	                                },
	                                category.name));
	                    }),
	                    React.createElement("div", {className: "separator right-side"}))));


	    }
	}

	class Header extends React.Component {
	    render() {
	        return (
	            React.createElement("div", {className: "header"},
	                React.createElement("div", {className: "stats"},
	                    React.createElement("div", {className: "separator left-side"}),
	                    React.createElement("div", {className: "title"}, this.props.activeCategory.name),
	                    React.createElement("div", {className: "separator right-side"})),

	                React.createElement("div", {className: "hp"},
	                    React.createElement("div", {className: "label"}, "HP"),
	                    React.createElement("div", {className: "value"}, "170")),

	                React.createElement("div", {className: "ap"},
	                    React.createElement("div", {className: "label"}, "AP"),
	                    React.createElement("div", {className: "value"}, "8/8")),

	                React.createElement("div", {className: "xp"},
	                    React.createElement("div", {className: "label"}, "XP"),
	                    React.createElement("div", {className: "value"}, "10"))));


	    }
	}

	class MainView extends React.Component {
	    constructor() {
	        super();
	        this.state = {datavalue: ""};
	        
			let audioHum = new Audio("audio/ui_pipboy_hum_lp.wav");
			audioHum.loop = true;
			audioHum.play();

			let audioTab = new Audio("audio/ui_pipboy_tab.wav");
			let audioAccess = new Audio("audio/ui_pipboy_access_down.wav");
			this.audioUserEvent = () => {
				audioTab.currentTime = 0;
				audioTab.play();
				audioAccess.currentTime = 0;
				audioAccess.play();
			}
	    }

	    componentDidMount() {
	        this.updateDatavalue();
	    }

	    componentDidUpdate(prevProps, prevState) {
	        if (prevState.datavalue === this.state.datavalue) {
	            this.updateDatavalue();
	        }
	    }

	    updateDatavalue() {
	        let activeitem = this.props.activeCategory.items.filter(item => {
	            return item.active;
	        })[0];
	        
	        let self = this;
            self.setState({datavalue: 'loading...'}, function(){

            	self.audioUserEvent();

		        activeitem.generateData()
		        	.then(datavalue => {
		            	self.setState({datavalue: datavalue});
		        	})
		        	.catch(error => {
						self.setState({datavalue: '[error]'});
					});            	
            });

	    }

	    render() {
	        let activeitem = this.props.activeCategory.items.filter(item => {
	            return item.active;
	        })[0];
	        return (
	            React.createElement("div", {className: "main-content"},
	                React.createElement("div", {className: "list-view"},
	                    React.createElement("ul", null,
	                        this.props.activeCategory.items.map((item, index) => {
	                            let setActive = this.props.setActive.bind(this, index);
	                            return (
	                                React.createElement("li", {
	                                        onClick: setActive,
	                                        className: item.active ? "active menu-option" : "menu-option"
	                                    },
	                                    item.displayName));
	                        }))),
	                React.createElement("div", {className: "main-view"},
	                    React.createElement("div", {className: "container-main"},
	                        React.createElement("div", {className: "center"},
	                            React.createElement("div", {className: "title"}, activeitem.displayName),
	                            React.createElement("div", {className: "value"}, this.state.datavalue))),
	                    React.createElement("div", {className: "description"}, activeitem.dataDescription))));
	    }
	}

	React.render(React.createElement(Page, null), document.getElementById("app"));

	//# sourceURL=pen.js