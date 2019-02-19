// noinspection JSUnresolvedVariable
Vue.component('note', {
    template: `
        <div
            :class="'card has-background-' + type"
            :style="styles"
        >
            <header class="card-header">
                <p class="card-header-title is-size-7 has-text-weight-light is-italic">
                    {{ createdAt }}
                </p>
                <span
                    class="card-header-icon"
                    aria-label="edit note"
                    @click="editing = true"
                >
                    <span class="icon has-text-grey">
                        <i class="fas fa-pen" aria-hidden="true"></i>
                    </span>
                </span>
                <span
                    class="card-header-icon"
                    aria-label="delete note"
                    @click="deleteMe"
                >
                    <span class="icon has-text-grey">
                        <i class="fas fa-times" aria-hidden="true"></i>
                    </span>
                </span>
            </header>
            <div class="card-content">
                <div v-if="editing">
                    <textarea
                        class="textarea is-medium"
                        :class="'has-background-' + type"
                        v-model="text"
                    ></textarea>
                    <button
                        @click="edit"
                        class="button"
                        style="display: block"
                    >
                        Edit note
                    </button>
                </div>
                <p
                    v-else
                    class="is-size-5 has-text-weight-semibold"
                    style="font-family: 'Indie Flower', cursive"
                >
                    {{ text }}
                </p>
            </div>
        </div>
        `,
    props: {
        propText: String,
        type: {
            type: String,
            validator: function (value) {
                return ['primary', 'info', 'success', 'warning', 'danger'].indexOf(value) !== -1;
            },
            default: "primary"
        },
        rotation: {
            type: Number,
            default: 0,
        },
        offset: {
            type: Number,
            default: 0,
        },
        createdAt: {
            type: String,
        },
        id: {
            type: Number,
            required: true,
        },
        index: {
            type: Number,
            required: true,
        }
    },
    data: function () {
        return {
            editing: false,
            text: this.propText,
        };
    },
    computed: {
        styles: function () {
            return {
                margin: '1em',
                boxShadow: '5px 5px 7px rgba(33,33,33,.7)',
                transform: 'rotate(' + this.rotation + 'deg)',
                top: this.offset,
            };
        },
    },
    methods: {
        deleteMe: function() {
            this.$emit('delete-note', this.index);
        },
        edit: function() {
            let zis = this;
            api.put('/notes/' + this.id, {
                'text': zis.text,
                'type': zis.type,
            })
                .then(function() {
                    zis.editing = false;
                })
                .catch(function(error){
                    console.log(error);
                    zis.editing = false;
                });
        }
    }
});
