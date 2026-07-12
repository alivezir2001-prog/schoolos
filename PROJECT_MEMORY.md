# Project Memory

This document records architectural decisions.

It is not a changelog.

It explains WHY decisions were made.

---

## 2026-07-13

TeachingAssignment introduced.

Reason:

Teacher-Lesson relation was insufficient.

Academic context required a first-class entity.

---

Observation will reference TeachingAssignment.

Reason:

Observations require educational context.

---

AcademicYear introduced.

Reason:

Every educational activity belongs to an academic cycle.

---

Repository becomes project memory.

Reason:

Conversations are temporary.

Project knowledge must live inside the repository.

## ADR-0007 — Two Intelligence Engines

Date: 2026-07-13

### Decision

SchoolOS will be designed around two complementary intelligence engines.

The first engine is responsible for understanding.

The second engine is responsible for supporting development.

These engines are intentionally separated.

---

## Understanding Engine

Purpose:

To transform educational reality into trustworthy understanding.

Pipeline:

Reality

↓

Observation

↓

Pattern

↓

Evidence

↓

Insight

The output of this engine is understanding.

---

## Development Engine

Purpose:

To transform understanding into educational action.

Possible pipeline:

Insight

↓

Professional Reflection

↓

Educational Action

↓

New Learning Experience

↓

New Observation

This engine is intentionally postponed.

It will be designed only after the Understanding Engine has been implemented and validated.

---

## Rationale

Understanding and intervention are fundamentally different educational processes.

SchoolOS should first become excellent at understanding learners before attempting to recommend educational actions.

Premature intervention models risk introducing bias and reducing trust.

The Development Engine will therefore be designed based on real classroom experience rather than theoretical assumptions.

---

## Status

Accepted

Deferred until Understanding Engine v1 is complete.


## ADR-0008

Evolutionary Development Model

SchoolOS'un gelişim modeli statik değildir. Sistem, mevcut gelişim boyutlarıyla açıklanamayan tutarlı örüntüleri "Candidate Development Dimensions" olarak önerebilir. Bu öneriler hiçbir zaman otomatik kabul edilmez. Yeni boyutlar yalnızca insanlardan oluşan bir eğitim komisyonunun değerlendirmesi ve onayıyla okulun gelişim modeline eklenebilir.
AI never creates Development Dimensions. AI proposes them. Humans define them.