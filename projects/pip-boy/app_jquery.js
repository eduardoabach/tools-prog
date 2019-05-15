
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
	                navigator.geolocation.getCurrentPosition(position => {
	                    resolve(
	                        `lat: ${position.coords.latitude} \n lon: ${
	                            position.coords.longitude
	                            }`);

	                });
	            } else {
	                alert("Geolocation is not supported by this browser.");
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
	            items: [new Coordinates(true), new TimeZone()]
	        },

	        {
	            name: "Device",
	            active: false,
	            items: [new Battery(true), new Language()]
	        }]
	};


	class Page {
	    constructor() {
	        this.state = Collection;
	        this.render();
	    }

	    setFooterActive(i) {
	        this.state.categories.map(c => {
	            c.active = false;
	        });
	        this.state.categories[i].active = true;
	        // this.setState({categories: this.state.categories});
	    }

	    setItemActive(i) {
	        let activecategoryindex = this.state.categories.map(e => {
	            return e.active;
	        }).indexOf(true);

	        this.state.categories[activecategoryindex].items.map(c => {
	            c.active = false;
	        });
	        this.state.categories[activecategoryindex].items[i].active = true;
	        // this.setState({categories: this.state.categories});
	    }

	    render() {
	        let activecategory = this.state.categories.filter(category => {
	            return category.active;
	        })[0];

	        Header {activeCategory: activecategory}
	        MainView {
                    setActive: this.setItemActive.bind(this),
                    activeCategory: activecategory
                }
	        Footer {
                    setActive: this.setFooterActive.bind(this),
                    categories: this.state.categories
                }



	    }
	}

	class Footer {
	    render() {
	    	var elFooter = $('.footer');
	    	var elListMenuOpt = elFooter.find('.menu-option');

	    	elListMenuOpt.on('click',function(){
	    		if(!$(this).hasClass('active')){
	    			$(this).addClass('active');
	    			elListMenuOpt.removeClass('active');
	    		}
	    	});

	    	this.props.categories.map((category, index) => {
                let setActive = this.props.setActive.bind(this, index);
                return (
                	React.createElement(
                    	"div", 
                    	{
                            onClick: setActive,
                            className:
                            category.active ? "active menu-option" : "menu-option"
                        },
                    	category.name
                    )
                );
            }),
            React.createElement("div", {className: "separator right-side"})
	    }
	}

	class Header {
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
	                    React.createElement("div", {className: "value"}, "10"))
                )
            );
	    }
	}

	class MainView {
	    constructor() {
	        super();
	        this.state = {datavalue: ""};
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
	        activeitem.generateData().then(datavalue => {
	            self.setState({datavalue: datavalue});
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
	                                React.createElement(
	                                	"li", 
	                                	{
	                                        onClick: setActive,
	                                        className: item.active ? "active menu-option" : "menu-option"
	                                    },
	                                    item.displayName
                                    )
                                );
	                        })
                        )
                    ),
	                React.createElement("div", {className: "main-view"},
	                    React.createElement("div", {className: "container-main"},
	                        React.createElement("div", {className: "center"},
	                            React.createElement("div", {className: "title"}, activeitem.displayName),
	                            React.createElement("div", {className: "value"}, this.state.datavalue)
                            )
                        ),
	                    React.createElement("div", {className: "description"}, activeitem.dataDescription)
                    )
                )
            );
	    }
	}

	// React.render(React.createElement(Page, null), document.getElementById("app"));