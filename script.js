const { createApp } = Vue;

createApp({
  data() {
    return {
      depValue: "1",
      nurseValue: "ivanova",
      shiftValue: "First",
      results: [],
      loading: false,
      lastQueryType: "",
    };
  },

  methods: {
    async fetchData(type, value) {
      this.loading = true;
      this.results = [];
      this.lastQueryType = type;

      try {
        const response = await fetch(`api.php?type=${type}&value=${value}`);
        this.results = await response.json();
      } catch (error) {
        console.error("Помилка:", error);
        alert("Сталася помилка при завантаженні даних");
      } finally {
        this.loading = false;
      }
    },
  },
}).mount("#app");
