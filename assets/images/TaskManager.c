#include <stdio.h>
#include <conio.h>
#include <string.h>

#define MAX_TASKS 100
#define MAX_HISTORY 100

struct Task {
	int id;
	char title[20];
	char description[100];
	int completed;
	int priority;       
	char dueDate[20];    
};

struct Task tasks[MAX_TASKS];
struct Task history[MAX_HISTORY];
int taskCount = 0;
int historyCount = 0;

void displayMenu() {
	printf("\n========== Task Manager Menu ==========\n");
	printf("1. Add Task\n");
	printf("2. View Tasks\n");
	printf("3. Mark Task as Completed\n");
	printf("4. Delete Task\n");
	printf("5. Deleted Task History\n");
	printf("6. Recover Task\n");
	printf("7. Delete All Completed Tasks\n");
	printf("8. Sort Tasks by Priority\n");
	printf("9. Search for Task\n");
	printf("10. Exit\n");
	printf("========================================\n");
	printf("Enter your choice: ");
}

void addTask() {
	struct Task newTask;

	printf("Enter task title: ");
	scanf_s("%s", newTask.title, sizeof(newTask.title));

	printf("Enter task description: ");
	scanf_s(" %[^\n]", newTask.description, sizeof(newTask.description));

	printf("Enter task priority (1-5, where 5 is the highest): ");
	scanf_s("%d", &newTask.priority);

	printf("Enter task due date (YYYY-MM-DD): ");
	scanf_s("%s", newTask.dueDate, sizeof(newTask.dueDate));

	newTask.completed = 0; 


	newTask.id = taskCount + 1;

	// Add the task to the array
	tasks[taskCount++] = newTask;

	printf("Task added successfully!\n");
}

void viewTasks() {
	if (taskCount == 0) {
		printf("No tasks available.\n");
		return;
	}

	printf("\n========== Task List ==========\n");
	printf("ID  \tTitle               \tDescription                    \tCompleted \tPriority \tDue Date\n");

	for (int i = 0; i < taskCount; i++) {
		printf("%-4d\t%-20s\t%-30s\t%-9s\t%-8d\t%-s\n", tasks[i].id, tasks[i].title, tasks[i].description,
			tasks[i].completed ? "Yes" : "No", tasks[i].priority, tasks[i].dueDate);
	}

	printf("================================\n");
}



void markTaskAsCompleted() {
	int taskId;
	printf("Enter the task ID to mark as completed: ");
	scanf_s("%d", &taskId);

	for (int i = 0; i < taskCount; i++) {
		if (tasks[i].id == taskId) {
			tasks[i].completed = 1;

			// Move the completed task to history
			history[historyCount++] = tasks[i];

			printf("Task marked as completed!\n");
			return;
		}
	}

	printf("Task not found with ID %d\n", taskId);
}

void deleteTask() {
	int taskId;
	printf("Enter the task ID to delete: ");
	scanf_s("%d", &taskId);

	for (int i = 0; i < taskCount; i++) {
		if (tasks[i].id == taskId) {
			
			history[historyCount++] = tasks[i];

			for (int j = i; j < taskCount - 1; j++) {
				tasks[j] = tasks[j + 1];
			}

			taskCount--;
			printf("Task deleted successfully!\n");
			return;
		}
	}

	printf("Task not found with ID %d\n", taskId);
}

void viewDeletedHistory() {
	if (historyCount == 0) {
		printf("No deleted tasks in history.\n");
		return;
	}

	printf("\n========== Deleted Task History ==========\n");
	printf("ID  \tTitle               \tDescription                    \tCompleted \tPriority \tDue Date\n");

	for (int i = 0; i < historyCount; i++) {
		printf("%-4d\t%-20s\t%-30s\t%-9s\t%-8d\t%-s\n", history[i].id, history[i].title, history[i].description,
			history[i].completed ? "Yes" : "No", history[i].priority, history[i].dueDate);
	}

	printf("==========================================\n");
}



void recoverTask() {
	int taskId;
	printf("Enter the task ID to recover: ");
	scanf_s("%d", &taskId);

	for (int i = 0; i < historyCount; i++) {
		if (history[i].id == taskId) {
		
			tasks[taskCount++] = history[i];

		
			for (int j = i; j < historyCount - 1; j++) {
				history[j] = history[j + 1];
			}

			historyCount--;
			printf("Task recovered successfully!\n");
			return;
		}
	}

	printf("Task not found with ID %d in history\n", taskId);
}

void deleteAllCompletedTasks() {
	for (int i = 0; i < taskCount; ) {
		if (tasks[i].completed) {
		
			history[historyCount++] = tasks[i];

	
			for (int j = i; j < taskCount - 1; j++) {
				tasks[j] = tasks[j + 1];
			}

			taskCount--;
		}
		else {
			i++;
		}
	}

	printf("All completed tasks deleted!\n");
}

void sortByPriority() {

	for (int i = 0; i < taskCount - 1; i++) {
		for (int j = 0; j < taskCount - i - 1; j++) {
			if (tasks[j].priority < tasks[j + 1].priority) {
			
				struct Task temp = tasks[j];
				tasks[j] = tasks[j + 1];
				tasks[j + 1] = temp;
			}
		}
	}

	printf("Tasks sorted by priority!\n");
}

void searchTask() {
	char searchTitle[50];
	printf("Enter the task title to search: ");
	scanf_s("%s", searchTitle, sizeof(searchTitle));

	int found = 0;
	printf("\n========== Search Results ==========\n");
	printf("ID  \tTitle               \tDescription                    \tCompleted \tPriority \tDue Date\n");

	for (int i = 0; i < taskCount; i++) {
		if (strstr(tasks[i].title, searchTitle) != NULL) {
			printf("%-4d\t%-20s\t%-30s\t%-9s\t%-8d\t%-s\n", tasks[i].id, tasks[i].title, tasks[i].description,
				tasks[i].completed ? "Yes" : "No", tasks[i].priority, tasks[i].dueDate);
			found = 1;
		}
	}

	if (!found) {
		printf("No matching tasks found.\n");
	}

	printf("====================================\n");
}


int main() {
	int choice;

	do {
		displayMenu();
		scanf_s("%d", &choice);

		switch (choice) {
		case 1:
			addTask();
			break;
		case 2:
			viewTasks();
			break;
		case 3:
			markTaskAsCompleted();
			break;
		case 4:
			deleteTask();
			break;
		case 5:
			viewDeletedHistory();
			break;
		case 6:
			recoverTask();
			break;
		case 7:
			deleteAllCompletedTasks();
			break;
		case 8:
			sortByPriority();
			break;
		case 9:
			searchTask();
			break;
		case 10:
			printf("Exiting the Task Manager. Goodbye!\n");
			break;
		default:
			printf("Invalid choice. Please enter a valid option.\n");
			break;
		}

		
		printf("\nPress any key to continue...");
		_getch();
		system("cls"); 

	} while (choice != 10);

	return 0;
}
