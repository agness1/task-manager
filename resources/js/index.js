const buttonForm = document.querySelector(".form-btn");
const buttonPdf = document.querySelector(".generate-pdf");
const buttonDelete = document.getElementsByClassName("delete-btn");
const form = document.querySelector("#taskInfo");

const deleteTask = async (task) => {
  const response = await fetch("http://localhost:8000/delete-task", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ taskId: task }),
  });
  if (response.ok) {
    console.log("Task deleted successfully.");
    window.location.reload();
  } else {
    console.error("Error deleting task.");
  }
};

const generatePdf = async () => {
  const response = await fetch("http://localhost:8000/pdf-task");
  if (response.ok) {
    window.open("http://localhost:8000/pdf-task", "_blank");
  } else {
    console.error("Error generating task.");
  }
};

buttonPdf.addEventListener("click", generatePdf);

async function generateTaskElements(task) {
  const container = document.createElement("div");
  container.classList.add("taskList-container");
  const taskDiv = document.createElement("div");
  taskDiv.classList.add("task");
  const titleParagraph = document.createElement("p");
  titleParagraph.textContent = task.title;
  taskDiv.appendChild(titleParagraph);

  const descriptionParagraph = document.createElement("p");
  descriptionParagraph.classList.add("task-description");
  descriptionParagraph.textContent = task.description;
  taskDiv.appendChild(descriptionParagraph);

  const deadlineParagraph = document.createElement("p");
  deadlineParagraph.textContent = task.deadline;
  taskDiv.appendChild(deadlineParagraph);

  container.appendChild(taskDiv);

  const deleteButton = document.createElement("button");
  deleteButton.classList.add("task-btn", "delete-btn");
  deleteButton.textContent = "Delete";
  deleteButton.addEventListener("click", function () {
    deleteTask(task.id);
  });
  container.appendChild(deleteButton);

  return container;
}

async function renderTasks() {
  const response = await fetch("http://localhost:8000/tasks");
  const tasks = await response.json();

  const tasksContainer = document.getElementById("tasks-container");

  tasks.forEach(async (task) => {
    const taskElement = await generateTaskElements(task);
    tasksContainer.appendChild(taskElement);
  });
}

document.addEventListener("DOMContentLoaded", renderTasks);

async function sendData() {
  const formData = new FormData(form);
  try {
    const response = await fetch("http://localhost:8000/task", {
      method: "POST",
      body: formData,
    });
    window.location.reload();
  } catch (e) {
    console.error(e);
  }
}

form.addEventListener("submit", (event) => {
  event.preventDefault();
  sendData();
});
